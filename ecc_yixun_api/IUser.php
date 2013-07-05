<?php
if (!defined("PHPLIB_ROOT")) {
	define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}
require_once(PHPLIB_ROOT . "lib/Config.php");
require_once(PHPLIB_ROOT . 'inc/IPCodeConfig.php');
require_once(PHPLIB_ROOT . 'inc/whiteName.php');
require_once(PHPLIB_ROOT . 'api/appplatform/user_api.php');
require_once(PHPLIB_ROOT . 'api/appplatform/user_point_api.php');

/*�����붨��
 10:emailΪ��
 11��email���Ϸ�
 12���ֻ���Ϊ��
 13���ֻ��Ų��Ϸ�
 14:��Ѹ�ʺ�Ϊ��
 15����Ѹ�ʺų�����󳤶�
 16:��Ѷ�ʺŻ�����Ϊ��
 17�����볤�Ȳ���
 18����ȡidgenerator ��ַ����
 19������id generator�����޷���
 20��id generator����������
 21��uid���Ϸ�
 22�������û���������Ϊ��
 23��qq�Ų��Ϸ�
 24����ȡ�û�����ʧ�ܣ��򲻴��ڸ��û�
 25��email�Ѿ���ռ��
 26��email�������������ݲ�һ��
 27�������ֻ������ʧ��
 28���Ѿ�������
 29��email���ڷ�����У����߲�����ĳ�û�
 30���ֻ���ռ��
 31���Ѿ����ֻ�
 32���ֻ�����δ�����涨ʱ�䣬���ܰ�ͬһ�˺���
 33���ֻ����ڷ�����У����߲�����ĳ�û�
 34��������в�����ĳ�û�����
 35��������֤����
 36���û�uid������
 137���û���ʹ����mail

 37:�ջ���Ϊ��
 38���ջ��˳��Ȳ��Ϸ�
 39:��������Ϊ��
 40���������볤�Ȳ��Ϸ�
 41:districtΪ��
 42:�ջ��ַΪ��
 43���ջ��ַ���Ȳ��Ϸ�
 44:��λ���Ƴ��Ȳ��Ϸ�

 45: ��ַ���aid���Ϸ�
 46:�û���Ӧ�ĵ�ַ��¼������
 47:��Ʊ���Ͳ��Ϸ�
 48: ��ƱtitleΪ��
 49����Ʊtitle���Ȳ��Ϸ�
 50����Ʊ��˾��Ϊ��
 51����Ʊ��˾�����Ȳ��Ϸ�
 52����Ʊ��˾��ַΪ��
 53����Ʊ��˾��ַ���Ȳ��Ϸ�
 54����Ʊ��˾�绰Ϊ��
 55����Ʊ��˾�绰���Ȳ��Ϸ�
 56����Ʊ��˾˰��Ϊ��
 57����Ʊ��˾˰�ų��Ȳ��Ϸ�
 58����Ʊ��˾�����ʺ�Ϊ��
 59����Ʊ��˾�����˺ų��Ȳ��Ϸ�
 60����Ʊ��˾��������Ϊ��
 61����Ʊ��˾�������г��Ȳ��Ϸ�

 62:��Ʊid���Ϸ�
 63����ַid���Ϸ�
 64:�û���Ӧ�ķ�Ʊ��¼������
 65:Ӱ���¼������Ϊ1

 66:�������
 67:�û�������
 68:�������Ѿ��������ʺ�ʹ��
 69:���ֻ������Ѿ��������ʺ�ʹ��
 */

class IUser
{
	public static $errMsg = "";
	public static $errCode = 0;

	private static $loginUid = false;

	private static $siteId = false;
	private static $siteKey = 'wsid';
	private static $siteKeyExpires = 2592000; // ����ʱ��һ���� 24 * 3600 * 30

	private static $provId = false;
	private static $cityId = false;// �˴���cityId,�����Ǽ�ͨipagent�ı���,��provId��ԭ��ѸIP��λ����IPS���루��server/IPS/tool/CityList.php $_ProvList��
//	private static $provKey = 'prid';
	const LOCATION_COOKIE = 'prid';

	private static $UPDATE_BIZ_ID = array(
		'USER'    => 1,
		'ADDRESS' => 2,
		'INVOICE' => 3,
	);

	const OPEN_ID_TYPE_NONE = 0;
	const OPEN_ID_TYPE_QQ = 1;
	const OPEN_ID_TYPE_ALI = 2;

	public static $WEB_ERP_PAIR_USER = array(
		// in the table of users
		'icsonid'          => 'CustomerID',
		'name'             => 'CustomerName',
		'sex'              => 'Gender',
		'email'            => 'Email',
		'phone'            => 'Phone',
		'mobile'           => 'CellPhone',
		'fax'              => 'Fax',
		'city'             => 'DwellAreaSysNo',
		'address'          => 'DwellAddress',
		'zipcode'          => 'DwellZip',
		'total_point'      => 'TotalScore',
		'valid_point'      => 'ValidScore',
		'idcard'           => 'CardNo',
		'note'             => 'Note',
		'regtime'          => 'RegisterTime',
		'level'            => 'CustomerRank',
		'is_manual_level'  => 'IsManualRank',
		'type'             => 'CustomerType',
		'regIP'            => 'RegisterIP',
		'exp_point'        => 'ExpPoint',
		'cash_point'       => 'CashValidScore',
		'promotion_point'  => 'SalesPromotionValidScore',
		'updatetime'       => 'rowModifydate',
		// in the table of icson_login
		'status'           => 'status',
		// in the table of email_login
		'email_status'     => 'EmailStatus',
		// in the table of tel_login
		'cellphone_status' => 'cellPhoneStatus',
		// in the table of user_extension
		'recomend_score'   => 'RecomendScore',
		'refer_uid'        => 'RefCustomerSysNo',
		'vip_rank'         => 'VIPRank',
		'web_power_group'  => 'WebPowerGroup',
	);


	//bits: array(1=>0, 2=>1,3=>0) //��ʾ�ڼ�λ����Ϊ0������1, ���ҵ����0��ʼ��λ
	public static function setStatusBits($uid, $bits)
	{
		if ($uid <= 0) {
			self::$errCode = 10;
			self::$errMsg = basename(__FILE__, '.php') . ' |' . __LINE__ . '[uid is invalid]';
			return false;
		}
		if (!is_array($bits) || count($bits) == 0) {
			self::$errCode = 11;
			self::$errMsg = basename(__FILE__, '.php') . ' |' . __LINE__ . '[bits is invalid]';
			return false;
		}

// 		$userBits = IUsersTTC::get($uid, array(), array('status_bits'));
		$userBits = self::getUsersTTC($uid);
		if (false === $userBits) {
			self::$errMsg = IUsersTTC::$errMsg;
			self::$errCode = IUsersTTC::$errCode;
			return false;
		}
		if (count($userBits) == 0) {
			self::$errMsg = "no such user";
			self::$errCode = -999;
			return false;
		}
		$bitProperty = $userBits[0]['status_bits'];
		$status_bits = 0;
		if(!empty($userBits[0]['status_bits'][8])){//�ձ���
			$status_bits |= 1;
		}
		if(!empty($userBits[0]['status_bits'][14])){//�Ƿ�����ֱ�־λ
			$status_bits |= 2;
		}
		if(!empty($userBits[0]['status_bits'][13])){//���ֻ�
			$status_bits |= 4;
		}
		if(!empty($userBits[0]['status_bits'][12])){//������
			$status_bits |= 8;
		}
		
		if(isset($bits[ALI_GOLDEN_USER])){
			if($bits[ALI_GOLDEN_USER] == 1){
				$bitProperty[8] = 1;
			}else if($bits[ALI_GOLDEN_USER] == 0){
				$bitProperty[8] = 0;
			}
		}
		if(isset($bits[NO_SCORE_USER])){
			if($bits[NO_SCORE_USER] == 1){
				$bitProperty[14] = 1;
			}else if($bits[NO_SCORE_USER] == 0){
				$bitProperty[14] = 0;
			}
		}
		
// 		$userBits[0]['status_bits'] = $status_bits;
// 		$oldBits = $userBits[0]['status_bits'];
		$oldBits = $status_bits;

		foreach ($bits as $key=> $bit) {
			if ($bit == 1) {
				$oldBits = ($oldBits | (1 << $key));
			} else if ($bit == 0) {
				$oldBits = ($oldBits & (~(1 << $key)));
			}
		}

		$ret = IUsersTTC::update(array('uid'=> $uid, 'status_bits'=> $oldBits));
		if (false === $ret) {
			self::$errMsg = IUsersTTC::$errMsg;
			self::$errCode = IUsersTTC::$errCode;
			return false;
		}
		UserWg::updateUserWg($uid, array('status_bits'=>$bitProperty));
		return true;
	}

	//bits: array(0,1,2,3) //��ʾ��Ҫ�ڼ�λ��ֵ�����ҵ����0��ʼ��λ
	public static function getStatusBits($uid, $bits)
	{
		if ($uid <= 0) {
			self::$errCode = 10;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[uid is invalid]';
			return false;
		}

		if (!is_array($bits) || count($bits) == 0) {
			self::$errCode = 11;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[bits is invalid]';
			return false;
		}

// 		$userBits = IUsersTTC::get($uid, array(), array('status_bits'));
		$userBits = self::getUsersTTC($uid);
		if (false === $userBits) {
			self::$errMsg = IUsersTTC::$errMsg;
			self::$errCode = IUsersTTC::$errCode;
			return false;
		}
		if (count($userBits) == 0) {
			self::$errMsg = "no such user";
			self::$errCode = -999;
			return false;
		}
		$status_bits = 0;
		if(!empty($userBits[0]['status_bits'][8])){//�ձ���
			$status_bits |= 1;
		}
		if(!empty($userBits[0]['status_bits'][14])){//�Ƿ�����ֱ�־λ
			$status_bits |= 2;
		}
		if(!empty($userBits[0]['status_bits'][13])){//���ֻ�
			$status_bits |= 4;
		}
		if(!empty($userBits[0]['status_bits'][12])){//������
			$status_bits |= 8;
		}
		$userBits[0]['status_bits'] = $status_bits;
		
		$oldBits = $userBits[0]['status_bits'];
		$returnArr = array();
		foreach ($bits as $bit) {
			$ret = ($oldBits & (1 << $bit)) == (1 << $bit) ? 1 : 0;
			$returnArr[$bit] = $ret;
		}

		return $returnArr;
	}


	private static function _purgeData4Str($ttcname, $str)
	{
		if (!empty($str))
			IAsyTask::purgeTTCData($ttcname, $str);
	}
	
	private static function _purgeData4StrV2($ttcName, $key)
	{
		if ($ttcName == '') {
			self::$errCode = 16;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[ttcName($ttcName) is invalid]";
			return false;
		}
		if ($key == '') {
			self::$errCode = 17;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[key($key) is invalid]";
			return false;
		}
		$ip = Config::getIP('asytask2');
		if (null == $ip)
		{
			self::$errCode = 18;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getip(asytask) failed]";
			return  false;
		}
		$addr = explode(":", $ip);
			
		$cmd = "cmd=200&ttcname=" . $ttcName . "&ttckey=" .$key .  "\r\n";
		$rspStr = NetUtil::udpCmd($addr[0], $addr[1], $cmd, false, 1);
		Logger::info("cmd[".$cmd."]addr=[".print_r($addr, true)."]rspStr[".$rspStr."]");
		if (false == $rspStr) {
			self::$errCode = 19;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[send package to asytask svr timeout]";
			return  false;
		}
		return true;
	}

	private static function _purgeData4Int($ttcname, $num)
	{
		IAsyTask::purgeTTCData($ttcname, $num);
	}

	private static function _startTrans($mysql, $line)
	{
		if (false === $mysql->execSql("begin")) {
			self::$errCode = $mysql->errMsg;
			self::$errMsg = basename(__FILE__, "php") . " | Line: $line _startTrans Error" . $mysql->errMsg;
			return false;
		}

		return true;
	}

	private static function _getDB($uid, $prefix, &$mysql, &$index, $line)
	{
		$index = ToolUtil::getUserDBTableIndex($uid);
		$mysql = ToolUtil::getDBObj($prefix, $index['db']);
		if (!$mysql) {
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = basename(__FILE__, 'php') . " | Line: $line _getDB Error" . ToolUtil::$errMsg;
			return false;
		}

		return true;
	}

	private static function _getDB2($str, $prefix, &$mysql, &$index, $line)
	{
		$hash = ToolUtil::TTCStr2Hash($str);
		$index = ToolUtil::getUserDBTableIndex($hash);
		$mysql = ToolUtil::getDBObj($prefix, $index['db']);

		if (!$mysql) {
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = basename(__FILE__, 'php') . " | Line: $line _getDB Error" . ToolUtil::$errMsg;
			return false;
		}

		return true;
	}

	private static function _getDB3($prefix, &$mysql, $line)
	{ //���ֿ�ֱ�mysql
		$mysql = ToolUtil::getDBObj($prefix);

		if (!$mysql) {
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = basename(__FILE__, 'php') . " | Line: $line _getDB Error" . ToolUtil::$errMsg;
			return false;
		}

		return true;
	}

	private static function _update($uid, $prefix, &$mysql, &$index, &$data, $condition, $line)
	{
		$uRet = $mysql->update($prefix . $index['table'], $data, $condition);
		if (false === $uRet) {
			self::$errCode = $mysql->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line: $line \n_update ($uid) info to mysql faild:" . $mysql->errMsg;
			$mysql->execSql("rollback");

			return false;
		}

		return true;
	}

	private static function _remove($uid, $prefix, &$mysql, &$index, $condition, $line)
	{
		$uRet = $mysql->remove($prefix . $index['table'], $condition);
		if (false === $uRet) {
			self::$errCode = $mysql->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line: $line _remove ($uid) info to mysql faild:" . $mysql->errMsg;
			$mysql->execSql("rollback");
			return false;
		}

		return true;
	}

	private static function _insert($uid, $prefix, &$mysql, &$index, &$data, $line)
	{
		if ($index != '') {
			$uRet = $mysql->insert($prefix . $index['table'], $data);
		} else {
			$uRet = $mysql->insert($prefix, $data);
		}
		if (false === $uRet) {
			self::$errCode = $mysql->errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line: $line _insert ($uid) info to mysql faild:" . $mysql->errMsg;
			$mysql->execSql("rollback");
			return false;
		}

		return true;
	}

	public static function _getTTCInfo($ttcname, $key, $filter = array(), $need = array())
	{
		$ttc = new $ttcname;
		$item = $ttc->get($key, $filter, $need);
		if (false === $item) {
			//self::$errCode = $ttcname::$errCode;
			//self::$errMsg = basename(__FILE__) . " | Line:" . __LINE__ . "[query {$ttcname} failed:" . $ttcname::$errMsg . "]";
			Logger::err("{$ttcname} get failed,errCode:" . self::$errCode . ",errMsg:" . self::$errMsg);
			return false;
		}
		return $item;
	}

	private static function _getTTCInfos($ttcname, $keys, $filter = array(), $need = array())
	{
		$ttc = new $ttcname;
		$items = $ttc->gets($keys, $filter, $need);
		if (false === $items) {
			//self::$errCode = $ttcname::$errCode;
			//self::$errMsg = basename(__FILE__) . " | Line:" . __LINE__ . "[query {$ttcname} failed:" . $ttcname::$errMsg . "]";
			Logger::err("{$ttcname} gets failed,errCode:" . self::$errCode . ",errMsg:" . self::$errMsg);
			return false;
		}
		return $items;
	}

	//tools
	/*
	 *���ĳ�����Ƿ��Ѿ�����ʹ�ã�δ�ذ�
	 */
	public static function checkEmailExist($email)
	{
		if (!isset($email) || "" == $email) {
			self::$errCode = 10;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[email is null]';
			return false;
		}

		if (!ToolUtil::checkEmail($email)) {
			self::$errCode = 11;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[email($email) is invalid]";
			return false;
		}

		// ��EmailLoginTTC����ȥ����
// 		$item = IEmailLoginTTC::get($email);
		$item = self::getEmailLoginByEmail($email);
		if (false === $item) {
			self::$errCode = IEmailLoginTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[query IEmailLoginTTC failed:" . IEmailLoginTTC::$errMsg . "]";
			return false;
		}

		return array('exist'=> count($item) > 0 ? 1 : 0);
	}

	//ͨ��email��ȡ�û�id������email������е�������Ϣ
	public static function getIdByEmail($email)
	{
		if (!isset($email) || "" == $email) {
			self::$errCode = 10;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[email is null]';
			return false;
		}
		if (!ToolUtil::checkEmail($email)) {
			self::$errCode = 11;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[email($email) is invalid]";
			return false;
		}

// 		$item = IEmailLoginTTC::get($email);
		$item = self::getEmailLoginByEmail($email);
		if (false === $item) {
			self::$errCode = IEmailLoginTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[query IEmailLoginTTC failed:" . IEmailLoginTTC::$errMsg . "]";
			return false;
		} else if (1 > count($item)) {
			self::$errCode = 12;
			self::$errMsg = "the email record is error";
			return false;
		}

		return $item;
	}

	/*
	 *���ĳ�ֻ��Ƿ��Ѿ�����ʹ�ã�δ�ذ�
	 */
	public static function checkMobileExist($mobile)
	{
		if (!isset($mobile) || "" == $mobile) {
			self::$errCode = 12;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[mobile is null]';
			return false;
		}

		if (!ToolUtil::checkMobilePhone($mobile)) {
			self::$errCode = 13;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[mobile($mobile) is invalid]";
			return false;
		}

// 		$item = self::_getTTCInfo("ITelLoginTTC", $mobile);
		$item = self::getTelLoginByMobile($mobile);
		return $item === false ? false : array('exist' => count($item) > 0 ? 1 : 0);
	}

	//checkEmailInIAS��checkMobileInIAS �Ǽ��email��mobile��IAS�Ƿ������Ϊ�Լ��������Ļ�bind���Լ���������ȥ������bind���ܽ��У��Ա�֤Ŀǰϵͳ�е�email��mobile��Ψһ

	/*
	 *���ĳ��Ѹ�˺��Ƿ�ռ�ã�ֻ����Լ��ͺ���
	 */
	public static function checkIcsonAccountExist($account)
	{
		if (!isset($account) || "" == $account) {
			self::$errCode = 14;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[account is null]';
			return false;
		}

		if (strlen($account) > MAX_ACCOUNT_LEN) {
			self::$errCode = 15;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[account($account) is invalid]";
			return false;
		}

// 		$item = self::_getTTCInfo('IIcsonLoginTTC', $account);
		$item = self::getUserInfoByAccount($account);
		return ($item === false) ? false : array('exist' => count($item) > 0 ? 1 : 0);
	}

	/*
	 *���ĳ��Ѹ�˺��Ƿ�ռ�ã�������QQ�ŵ�¼ר��
	 */
	public static function checkIcsonAccountExist4Mobile($account,$qq)
	{
		global $_LoginType,$_AccountType;
		$userInfo = UserWg::GetUserInfoByQQorAccount($_AccountType['qq'], $account, $qq);
		if ($userInfo === false) {
			Logger::err("user_loginqq UserWg::GetUserInfoByQQorAccount failed-" . UserWg::$errCode . '-' . UserWg::$errMsg);
			return false;
		}
		
		if(!empty($userInfo)){
			return array('exist' => 1, 'icsonAccount' => $account, 'loginType' => $_LoginType['qq']);
		}else{
			return array('exist' => 0, 'icsonAccount' => $account, 'loginType' => $_LoginType['qq']);
		}
		/*$exists = self::checkIcsonAccountExist($account);
		if ($exists === false) {
			return false;
		}
		global $_LoginType;
		if ($exists['exist'] == 0) {
			$item = IUsersQqMapTTC::get($qq);
			if(false===$item){
				Logger::err("Check IUsersQqMapTTC  fail. qq: $qq, " . IUsersQqMapTTC::$errCode . ": " . IUsersQqMapTTC::$errMsg);
				return false;
			}
			if(count($item)==1){
// 				$icsonAccount = IUsersTTC::get($item[0]['uid']);
				$icsonAccount = self::getUsersTTC($item[0]['uid']);
				if(false===$icsonAccount){
					Logger::err("Check IUsersTTC fail. uid: $item[0]['uid']");
					return false;
				}
				if(count($icsonAccount)==1){
					return array('exist' => 1, 'icsonAccount' => $icsonAccount[0]['icsonid'], 'loginType' => $_LoginType['icson']);
				}
			}
			return array('exist' => 0, 'icsonAccount' => $account, 'loginType' => $_LoginType['qq']);
		}else{
			return array('exist' => 1, 'icsonAccount' => $account, 'loginType' => $_LoginType['qq']);
		}*/
	}

	/**
	 * ��ȡ��ǰ��¼̬�û���uid
	 * @param boolean $noCache �Ƿ�ȡ�����uid��һ������£�һ���Ự�У���¼̬��uid����仯
	 * @return int ��¼̬�û���UID
	 * $src = 0 ������ͨ��֤����
	 * $src = 1 ��������app��������Ч�ڽ��Ƚϳ�
	 */
	public static function getLoginUid($noCache = false)
	{
		$uid = 0;
		if (empty($_COOKIE['uid'])) {
			$uid = 0;
		} else if (!ToolUtil::checkInt($_COOKIE['uid'])) {
			$uid = 0;
		} else {
			// ���û�г�ʼ������uid�����仯
			if (self::$loginUid === false || self::$loginUid != $uid) {
				$src = 0;
				$checkToken = isset($_COOKIE['token']) && !empty($_COOKIE['token']);

				if ($checkToken) {
					if ($_COOKIE['token'] === md5($_COOKIE['uid'] . APP_LOGIN_RENEWAL_KEY)) {
						$src = 1;
					}
				}

				if(!empty($_COOKIE['wg_skey']) && $src == 0){
					$checkLoginResult = UserWg::CheckLoginByIcsonUid($_COOKIE['uid'],$_COOKIE['wg_skey']);
					if($checkLoginResult === false){
						$uid = false;
					}else{
						$uid = $_COOKIE['uid'];
					}
				}else if(!empty($_COOKIE['skey'])){
						$checkUid = self::checkSession($_COOKIE['uid'], $_COOKIE['skey'], $src);
						if ($checkUid === false) {
// 							$uid = false;
							$checkLoginResult = UserWg::CheckLoginByIcsonUid($_COOKIE['uid'],$_COOKIE['skey']);
							if($checkLoginResult === false){
								$uid = false;
							}else{
								$uid = $_COOKIE['uid'];
							}
						}else{
							$uid = $checkUid;
						}
						
				}
				if($uid){
					$user = self::getUserInfo($uid);
					if ($user === false && self::$errCode === 0) { // �û������ڣ���Ū��
						$uid = 0;
					}
				}

				self::$loginUid = $uid;
			} else {
				$uid = self::$loginUid;
			}
		}

		// ���жϼ���
		if (empty($uid)) {
			//$expires = time() - 1;
			setcookie("uid", "", 1, "/", ".51buy.com");
			setcookie("skey", "", 1, "/", ".51buy.com");
			setcookie("wg_skey", "", 1, "/", ".51buy.com");

			// Modified on 2012/09/28, as Android/iOS client will also retrieve login id via cookies,
			// with same macro definition IN_MOBILE. Move check for wap here.
			// In wap version, uid should be empty.
			if (defined('IN_MOBILE')) {
				$uid = WapUtil::getLoginUid();
			}
			// End of the modification.
		}

		return $uid;
	}

	/**
	 * ���email��uid�ĺϷ���
	 */
	private static function checkEmailAndUid($uid, $email)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid is null';
			return false;
		}

		if (!isset($email) || "" == $email) {
			self::$errCode = 10;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'email is null';
			return false;
		}

		if (!ToolUtil::checkEmail($email)) {
			self::$errCode = 11;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "email($email) is invalid";
			return false;
		}

		return true;
	}

	/**
	 * ����ֻ���uid�ĺϷ���
	 */
	private static function checkMobileAndUid($uid, $mobile)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid is null';
			return false;
		}

		if (!isset($mobile) || "" == $mobile) {
			self::$errCode = 12;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'mobile is null';
			return false;
		}

		if (11 != strlen($mobile) || !ToolUtil::checkMobilePhone($mobile)) {
			self::$errCode = 13;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "mobile($mobile) is invalid";
			return false;
		}

		return true;
	}


	//��֤��¼̬
	//$src = 0 ������ͨ��֤����
	//$src = 1 ��������app��������Ч�ڽ��Ƚϳ�
	public static function checkSession($uid, $skey, $src = 0)
	{
		if (!is_numeric($uid) || $uid < 0) {
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[uid is invalid!]";
			return false;
		}

		if (!isset($skey) || $skey == "") {
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[skey is invalid!]";
			return false;
		}

		//��֤skey
		$cmd = "cmd=3000&uid=" . $uid . "&skey=" . $skey . "&src=$src\r\n";
		$rspStr = self::getSession($uid, $cmd);
		if (false == $rspStr) {
			return false;
		}

		$rspArr = json_decode($rspStr, true);
		if ($rspArr['errCode'] == 0) {
			return $uid;
		}

		return false;
	}

	private static function getSession($uid_, $cmd_, $time_ = 0)
	{
		$index = (intval($uid_) + $time_) % 2;
		$ip = Config::getIP('sessiond_' . $index);

		if (NULL == $ip) {
			self::$errCode = 110;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[getip(sessiond) failed ($ip : session_{$index} : time {$time_} : cmd {$cmd_})]";
			return false;
		}

		$addr = explode(":", $ip);
		$rspStr = NetUtil::tcpCmd($addr[0], $addr[1], $cmd_, 1, 1);
		if (false == $rspStr || "" == $rspStr) {
			/*if ($time_ < 3) {
				Logger::info("[sessiond svr timeout and try again ($ip : session_{$index} : time {$time_} : cmd {$cmd_})]");
				$time_++;
				return self::getSession($uid_, $cmd_, $time_);
			} else {*/
				self::$errCode = 111;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[sessiond svr timeout ($ip : session_{$index} : time {$time_} : cmd {$cmd_})]";
				Logger::info("[sessiond svr timeout ($ip : session_{$index} : time {$time_} : cmd {$cmd_},rspStr:".$rspStr.")]");
				return false;
			//}
		}

		//Logger::info("get session success ($ip : session_{$index} : time {$time_} : cmd {$cmd_})");
		return $rspStr;
	}

	//invoice
	public static function addInvoice($uid, $newInvoice)
	{
		$ret = EA_Invoice::insert($uid, $newInvoice);
		if (false === $ret) {
			self::$errCode = EA_Invoice::$errCode;
			self::$errMsg = EA_Invoice::$errMsg;
			return false;
		}
		return $ret;
	}

	public static function delInvoice($uid, $iid)
	{
		$ret = EA_Invoice::del($uid, $iid);
		if (false === $ret) {
			self::$errCode = EA_Invoice::$errCode;
			self::$errMsg = EA_Invoice::$errMsg;
			return false;
		}
		return $ret;
	}


	/**
	 * @static �޸ķ�Ʊ
	 * @param $uid
	 * @param $iid
	 * @param $newInvoice
	 * @return bool
	 * �����Ѿ���֣���ֱ�ӵ��� IInvoice::update
	 */
	public static function modifyInvoice($uid, $iid, $newInvoice)
	{
		$newInvoice['uid'] = $uid;

		if (!isset($iid) || $iid <= 0) {
			self::$errCode = 63;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'iid is null';
			return false;
		}

		$ret = EA_Invoice::update($newInvoice, array('iid'=> $iid));
		if (false === $ret) {
			self::$errCode = EA_Invoice::$errCode;
			self::$errMsg = EA_Invoice::$errMsg;
			return false;
		}
		return true;
	}

	/**
	 * @static �����û���Ʊ
	 * @param $uid
	 * @param $iid
	 * @param $newInvoice
	 * @return bool
	 * �����Ѿ���֣���ֱ�ӵ��� IInvoice::get
	 */
	public static function getUserInvoice($uid, $iid = 0, $type = 0, $from = 0)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid is null';
			return false;
		}

		$filter = array();
		if ($from == 0) {
			$filter = array('status' => INVOICE_STATUS_OK);
		}

		if ($iid > 0) {
			$filter['iid'] = $iid;
		}
		if ($type > 0) {
			$filter['type'] = $type;
		}

		$ret = EA_Invoice::get($uid, $filter);
		if (false === $ret) {
			self::$errCode = EA_Invoice::$errCode;
			self::$errMsg = EA_Invoice::$errMsg;
			return false;
		}

		return $ret;
	}


	//��Ϊerpͬ���ã���ȡһ���û���Ʊ����Ϣ���ȼ�ʵ�֣���ͨ�߼����������getUserInvoice($uid, $iid=0, $type=0)
	public static function getUserInvoices($uids)
	{
		$invoicelist = array();

		foreach ($uids as $item) {
			$ret = self::getUserInvoice($item['uid'], $item['iid'], 0, 1);
			if ($ret == false) {
				continue;
			}

			$invoicelist[] = $ret;
		}

		return $invoicelist;
	}


	// address
	//����from�ĺ���ͬgetinvoice
	public static function getUserAddress($uid, $aid = 0, $from = 0)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid is null';
			return false;
		}

		$filter = array();

		if ($from == 0) {
			$filter = array('status' => ADDRESS_STATUS_OK);
		}

		if ($aid > 0) {
			$filter['aid'] = $aid;
		}

		$ret = EA_Address::get($uid, $filter);

		if (false === $ret) {
			self::$errCode = EA_Address::$errCode;
			self::$errMsg = EA_Address::$errMsg;
			return false;
		}
		return $ret;
	}

	//��Ϊerpͬ���ã���ȡһ���û���ַ����Ϣ���ȼ�ʵ�֣���ͨ�߼����������getUserAddress($uid, $aid = 0)
	public static function getUserAddresses($uids)
	{
		$addresslist = array();

		foreach ($uids as $item) {
			$ret = self::getUserAddress($item['uid'], $item['aid'], 1);
			if ($ret == false) {
				continue;
			}

			$addresslist[] = $ret;
		}

		return $addresslist;
	}


	public static function delAddress($uid, $aid)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid is null';
			return false;
		}

		if (!isset($aid) || $aid <= 0) {
			self::$errCode = 63;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'aid is null';
			return false;
		}

		$newAddress['uid'] = $uid;
		$newAddress['status'] = ADDRESS_STATUS_DELETED;
		$newAddress['updatetime'] = time();

		$ret = IUserAddressBookTTC::update($newAddress, array('aid'=> $aid));
		if (false === $ret) {
			self::$errCode = IUserAddressBookTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[delete user addr($aid) from IUserAddressBookTTC failed:" . IUserAddressBookTTC::$errMsg . "]";
			return false;
		}

		$lines = IUserAddressBookTTC::getTTCAffectRows();
		if (1 != $lines) {
			self::$errCode = 65;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[delete user addr($aid) affect $lines rows";
			return false;
		}

		// update modify time for asyn to ERP
		//self::updateUserModifyTime($aid, "ADDRESS", $uid);
		IUserAddressSyn::delete(array('uid'=> $uid, 'aid'=> $aid));

		return true;
	}


	/**
	 * @static Ϊ�û���ӵ�ַ
	 * @param $uid �û�ID
	 * @param $newAddr ��ַ����
	 * @return bool|int
	 * �ӿ��Ѿ���֣���ֱ�ӵ��� EA_Address::insert
	 */
	public static function addAddress($uid, $newAddr)
	{
		$ret = EA_Address::insert($uid, $newAddr);
		if (false === $ret) {
			self::$errCode = EA_Address::$errCode;
			self::$errMsg = EA_Address::$errMsg;
			return false;
		}
		return $ret;
	}

	public static function modifyAddress($uid, $aid, $newAddr)
	{
		$newAddr['uid'] = $uid;
		if (!isset($aid) || $aid <= 0) {
			self::$errCode = 63;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'aid is null';
			return false;
		}

		$ret = EA_Address::update($newAddr, array('aid'=> $aid));
		if (false === $ret) {
			self::$errCode = EA_Address::$errCode;
			self::$errMsg = EA_Address::$errMsg;
			return false;
		}
		return true;
	}

	//users
	/**
	 *ע�����û�
	 */
	public static function register($account, $pass, $userData = array(), $qq=0)
	{
		global $_EmailStat;
		global $_IcsonAccStat;
		global $_USER_TYPE;
		global $_IP_CFG;
		global $_LoginType;

		$email = isset($userData['email']) ? $userData['email'] : '';
		$regIp = isset($userData['regIP']) ? $userData['regIP'] : '';
		$warehouseId = isset($userData['warehouseId']) ? $userData['warehouseId'] : 1;
		$source = isset($userData['source']) ? $userData['source'] : '';
		$referUid = isset($userData['referUid']) ? $userData['referUid'] : -999999;
		$tel = isset($userData['tel']) ? $userData['tel'] : '';
		$name = isset($userData['name']) ? $userData['name'] : '';
		$isRetailer = isset($userData['isRetailer']) ? $userData['isRetailer'] : false;

		if (!isset($account) || !isset($pass) || "" == $account || "" == $pass) {
			self::$errCode = 16;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[account or pass is null]';
			return false;
		}

		if (strlen($account) > MAX_ACCOUNT_LEN) {
			self::$errCode = 15;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[account len is invalid]';
			return false;
		}

		$passLen = strlen($pass);
		if ($passLen < MIN_PASS_LEN || $passLen > MAX_PASS_LEN) {
			self::$errCode = 17;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[pass len is invalid]';
			return false;
		}

		//�����д�����䣬����������У��
		if ("" != $email) {
			//��������Ƿ��Ѿ���ʹ��
			$ret = self::checkEmailExist($email);
			if (false === $ret) {
				return false;
			} else if ($ret['exist'] != 0) {
				self::$errCode = 25;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[email($email) is used]";
				return false;
			}
		}

		//����û�������û����Ƿ�ռ��
		$ret = self::checkIcsonAccountExist($account);
		if (false === $ret) {
			return false;
		} else if ($ret['exist'] != 0) {
			self::$errCode = 26;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[account($account) is used]";
			return false;
		}
		global $_AccountType;
		$accountType = $_AccountType['custom'];
		$ptskey = "";
		$passwd = $pass;
		if(0 === stripos($account, QQ_ACCOUNT_PRE)){
			$accountType = $_AccountType['qq'];
		}else{
			$passwd = $account;
		}
		$registerResult = UserWg::IcsonUniformLogin($accountType, $account, $ptskey, $passwd, $qq);
		
		// 	$session = IUser::login($account, $password, $clientIp, 1, 3, true, $qq, $ptskey);
		if ($registerResult === false) {
			Logger::err("IUser::login failed-UserWg::IcsonUniformLogin" . UserWg::$errCode . '-' . UserWg::$errMsg);
			return false;
		}
		return true;
		
		$source_id = 0;
		if (!empty($source)) {
			$source = strtolower($source);
			$source = preg_replace("/(\d+)/i", "", $source);
			$soucreInfo = IEntrySourceTTC::get($source);
			if (count($soucreInfo) === 1) {
				$source_id = $soucreInfo[0]['sid1'];
			}
		}

		//��ȡһ��Ψһ�û�uid
		$newId = IIdGenerator::getNewId('Customer_Sequence');
		if (false === $newId || $newId <= 0) {
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return false;
		}
		//��ȡid�ɹ�

		//���������ݣ��Ȳ����û�����,�ٲ�����Ѹ������ٲ��������
		global $_UserType;
		$now = time();
		$newUser = array();
		$newUser['uid'] = $newId;
		$newUser['icsonid'] = $account;
		$newUser['email'] = isset($email) ? $email : "";
		$newUser['mobile'] = isset($userData['mobile']) ? $userData['mobile'] : '';
		$newUser['qq'] = 0;
		$newUser['name'] = $name;
		$newUser['nick'] = "";
		$newUser['face'] = 0;
		$newUser['sex'] = 'n';
		$newUser['year'] = 0;
		$newUser['month'] = 0;
		$newUser['day'] = 0;
		$newUser['identity'] = 0;
		$newUser['level'] = 0;
		$newUser['total_point'] = 0;
		$newUser['valid_point'] = 0;
		$newUser['idcard'] = "";
		$newUser['status'] = 0;
		$newUser['phone'] = $tel;
		$newUser['fax'] = isset($userData['fax']) ? $userData['fax'] : '';
		$newUser['city'] = isset($userData['district']) ? $userData['district'] : 0;
		$newUser['address'] = isset($userData['address']) ? $userData['address'] : 0;
		$newUser['zipcode'] = isset($userData['zipCode']) ? $userData['zipCode'] : '';
		$newUser['updatetime'] = $now;
		$newUser['regsrc'] = $source_id;
		$newUser['regtime'] = $now;
		$newUser['note'] = isset($userData['info']) ? $userData['info'] : '';
		$newUser['type'] = $_UserType['Personal'];
		$newUser['regIP'] = $regIp;
		$newUser['exp_point'] = 0;
		$newUser['promotion_point'] = 0;
		$newUser['cash_point'] = 0;
		$newUser['reg_warehouse_id'] = $warehouseId;
		$newUser['refer_uid'] = $referUid;
		if (false === $referUid) {
			$newUser['refer_uid'] = -999999;
		}
		$newUser['recomend_score'] = -999999;
		$newUser['vip_rank'] = -999999;
		$newUser['web_power_group'] = -999999;
		$newUser['retailerLevel'] = 0;

		//��ʼ������������û�

		// ����account����û��˻�Ӧ����ı��index
		if (false === self::_getDB2($account, "icson_login", $mysql, $index, __FILE__)) {
			return false;
		}

		if (false === $mysql->execSql("begin")) {
			self::$errCode = $mysql->errCode;
			self::$errMsg = basename(__FILE__, "php") . " | " . __LINE__ . " start transaction failed! " . $mysql->errMsg;
			return false;
		}

		try {

			$data = array(
				'icsonid'   => $account,
				'uid'       => $newId,
				'status'    => $_IcsonAccStat['normal'],
				'updatetime'=> $now,
			);
			$ret = self::_insert($newId, "t_icson_login_", $mysql, $index, $data, __LINE__);
			if (false === $ret) {
				throw new BaseException(110, 'Failed to create login.');
			}

			//����Ƿ������û����������̱�
			if ($isRetailer) {
				// �����û���
				if (false === self::_getDB3("retailer", $mysql, __LINE__)) {
					//Logger::err($mysql);
					throw new BaseException(120, "Failed to connect db retailer.");
				}

				$newUser['type'] = $_USER_TYPE['RetailersUser']; //;
				$data = array(
					'uid'          => $newId,
					'icsonid'      => $account,
					'name'         => $name,
					'tel'          => $tel,
					'email'        => $email,
					'retailerType' => $_USER_TYPE['DistributionRetailer'],
					'level'        => 0,
					'regTime'      => $now,
					'status'       => 0,
					'regIP'        => $regIp,
					'district'     => isset($userData['district']) ? $userData['district'] : 0,
					'address'      => isset($userData['address']) ? $userData['address'] : '',
					'zipcode'      => isset($userData['zipCode']) ? $userData['zipCode'] : '',
					'info'         => isset($userData['info']) ? $userData['info'] : '',
					'conpanyName'  => isset($userData['conpanyName']) ? $userData['conpanyName'] : '',
					'mobile'       => isset($userData['mobile']) ? $userData['mobile'] : '',
					'fax'          => isset($userData['fax']) ? $userData['fax'] : '',
				);
				$temp = '';
				if (false === self::_insert($newId, "t_retailer", $mysql, $temp, $data, __LINE__)) {
					throw new BaseException(130, 'Failed to create new retailer user.');
				}
			}

			// �����
			if (false === self::_getDB($newId, "user_pass", $mysql, $index, __LINE__)) {
				throw new BaseException(140, 'Failed to connect to db user_pass.');
			}

			$data = array(
				'uid'       => $newId,
				'createtime'=> $now,
				'updatetime'=> $now,
				'pass'      => '',
				'password'  => md5($pass),
			);

			if (false === self::_insert($newId, "t_user_pass_", $mysql, $index, $data, __LINE__)) {
				throw new BaseException(150, 'Failed to create password.');
			}

			// email��¼��
			if (isset($email) && $email != "") {
				if (false === self::_getDB2($email, "email_login", $mysql, $index, __FILE__)) {
					throw new BaseException(160, 'Failed to connect db email_login.');
				}

				$data = array(
					'email'     => $email,
					'uid'       => $newId,
					'status'    => $_EmailStat['normal'],
					'updatetime'=> $now,
				);

				if (false === self::_insert($newId, "t_email_login_", $mysql, $index, $data, __LINE__)) {
					throw new BaseException(170, 'Failed to create email record.');
				}
			}

			// �û���
			if (false === self::_getDB($newId, "users", $mysql, $index, __LINE__)) {
				throw new BaseException(180, 'Failed to connect db users.');
			}

			if (false === self::_insert($newId, "t_users_", $mysql, $index, $newUser, __LINE__)) {
				throw new BaseException(190, 'Failed to create user.');
			}

			// ��erp�в�������
			$erpDB = ToolUtil::getMSDBObj('Customer');
			if (false === $erpDB) {
				self::$errCode = ToolUtil::$errCode;
				self::$errMsg = ToolUtil::$errMsg;
				throw new BaseException(200, 'Failed to connect msdb Customer.');
				//$mysql->execSql("rollback");
				//return false;
			}

			$data = array(
				"SysNo"                   => $newUser['uid'],
				"CustomerID"              => $newUser['icsonid'],
				"CustomerName"            => $newUser['name'],
				"Gender"                  => ('m' == $newUser['sex']) ? 1 : (('f' == $newUser['sex']) ? 0 : 2),
				"Email"                   => $newUser['email'],
				"Phone"                   => $newUser['phone'],
				"Pwd"                     => md5($pass),
				"CellPhone"               => $newUser['mobile'],
				'Status'                  => $_IcsonAccStat['normal'],
				'EmailStatus'             => $_EmailStat['normal'],
				"Fax"                     => $newUser['fax'],
				"DwellAreaSysNo"          => $newUser['city'],
				"DwellAddress"            => $newUser['address'],
				"DwellZip"                => $newUser['zipcode'],
				"TotalScore"              => $newUser['total_point'],
				"ValidScore"              => $newUser['valid_point'],
				"CardNo"                  => $newUser['idcard'],
				"Note"                    => $newUser['note'],
				"RegisterTime"            => date('Y-m-d H:i:s', $newUser['regtime']),
				"CustomerRank"            => $newUser['level'],
				"CustomerType"            => $newUser['type'],
				"RegisterIP"              => $newUser['regIP'],
				"ExpPoint"                => $newUser['exp_point'],
				"CashValidScore"          => $newUser['cash_point'],
				"SalesPromotionValidScore"=> $newUser['promotion_point'],
				"rowModifydate"           => date('Y-m-d H:i:s', $newUser['regtime']),
			);

			$ret = $erpDB->insert("Customer", $data);
			if (false === $ret) {
				self::$errCode = $erpDB->errCode;
				self::$errMsg = $erpDB->errMsg;
				throw new BaseException(210, 'Failed to create Customer.');
			}

			if ($mysql->execSql("commit") === false) {
				throw new BaseException(220, 'Failed to commit mysql.');
			}

			if (IEmailLoginTTC::purge($newUser['email']) === false) {
				Logger::err("Failed to purge ttc_email_login. [ uid : $newId ]");
			}

			if (IIcsonLoginTTC::purge($account) === false) {
				Logger::err("Failed to purge ttc_icson_login. [ uid : $newId ]");
			}

			if (IUserPassTTC::purge($newId) === false) {
				Logger::err("Failed to purge ttc_user_pass. [ uid : $newId ]");
			}

			if (IUsersTTC::purge($newId) === false) {
				Logger::err("Failed to purge ttc_users. [ uid : $newId ]");
			}
			//����ӿ�
			if(stripos($account, QQ_ACCOUNT_PRE) === 0)
			{
				//��������
				
// 				if (is_array($_IP_CFG['QQ_OPENIDS'])) {
// 					$ip_key = array_rand($_IP_CFG['QQ_OPENIDS'], 1);
// 					$ip = $_IP_CFG['QQ_OPENIDS'][$ip_key];
// 				} else {
// 					$ip = $_IP_CFG['QQ_OPENIDS'];
// 				}

// 				$url = "http://".$ip.":8080/openid/decopenid.php?func=getuinbyopenid&openid=" . $account;
// 				$qqinfo = NetUtil::cURLHTTPGet($url);
// 				$ret = json_decode($qqinfo);
// 				$qq = $ret->uin;
// 				if($qq){
// 					UserWg::ImportCopartnerUserInfo($newId, $qq, $_LoginType['qq']);
// 				}else{
					UserWg::ImportCopartnerUserInfo($newId, $account, $_LoginType['qq']);
// 				}
			}
			else
			{
				UserWg::ImportCopartnerUserInfo($newId, $account, 2);
			}
			

			return $newId;

		} catch (BaseException $e) {
			Logger::err($e->errCode . ' : ' . $e->errMsg . " [ uid : $newId ]");
			if (!self::$errCode) {
				self::$errCode = $e->errCode;
				self::$errMsg = $e->errMsg;
			}

			if ($mysql->execSql("rollback") === false) {
				Logger::err('Failed to rollback mysql. [' . $mysql->errCode . ' : ' . $mysql->errMsg . ']');
			}

			if ($e->errCode >= 210) {
				$ret = $erpDB->update("Customer", array('Status' => $_IcsonAccStat['invalid']), "SysNo = {$newUser['uid']}");
				if ($ret === false) {
					Logger::err('Failed to rollback erp. [' . $erpDB->errCode . ' : ' . $erpDB->errMsg . ']');
				}
			}
			return false;
		}

		//DataReport::report(1, DATA_TYPE_REALTIME, array($newId,date('Y-m-d H:i:s'),$source_id,$warehouseId,$regIp));

	}

	/**
	 * �����û����ϣ������������к���email������Ҫ���email�Ƿ��Ѱ󶨣����Ѿ��󶨣��򲻸���email�����������ֶΣ��ֻ�����
	 * $uid: �û����ڲ�id
	 * $info : ���������飬����
	 * $info = {
	 * 'email' => 'xxxxxxx',
	 * 'year' =>1984,
	 * }
	 * ����ֵ��
	 * false��ʧ��
	 * ��false���ɹ�

	 */
	private static function userWriteLog($str)
	{
		EL_Flow::getInstance("userOperation")->append($str);
	}

	public static function updateUser($uid, $newInfo)
	{
		global $_EmailStat;
		global $_IcsonAccStat;
		global $_MobileStat;
		self::userWriteLog("uid:{$uid},submit request,line:" . __LINE__ . ",newInfo:" . ToolUtil::gbJsonEncode($newInfo));
		//������
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[uid($uid) is invalid]";
			return false;
		}

		if (!is_array($newInfo) || count($newInfo) == 0) {
			self::$errCode = 22;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[update new newInfo array is empty]";
			return false;
		}
		//��Ѹid���ܸ���
		unset($newInfo['icsonid']);

		if (isset($newInfo['qq']) && $newInfo['qq'] < 10000) {
			self::$errCode = 23;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[new newInfo[qq](" . $newInfo['qq'] . ") is invalid]";
			return false;
		}
		if (isset($newInfo['email']) && $newInfo['email'] == '') {
			unset($newInfo['email']);
		}
		if (isset($newInfo['mobile']) && $newInfo['mobile'] == '') {
			unset($newInfo['mobile']);
		}

		$userOldInfo = array();
		$needTodeleteEmail = false;
		$needToinsertEmail = false;
		$needTodeleteMobile = false;
		$needToinsertMobile = false;

		//��ȥ��һ���û���Ϣ
		//$userOldInfo = self::_getTTCInfo("IUsersTTC", $uid);
		$userOldInfo = self::getUsersTTC($uid);
		if ($userOldInfo === false)
			return false;

		self::userWriteLog("uid:{$uid},getUserInfo,line:" . __LINE__ . ",userOldInfo:" . ToolUtil::gbJsonEncode($userOldInfo));

		$userOldInfo = $userOldInfo[0];
		global $_EmailStat;
		//����û���д��һ���µ�email��ַ
		if (isset($newInfo['email']) && $newInfo['email'] != '') {
			if ($newInfo['email'] == $userOldInfo['email']) {
				self::userWriteLog("uid:{$uid},unset newInfo's email,line:" . __LINE__);
				unset($newInfo['email']);
			} else {
				$exist = self::checkEmailExist($newInfo['email']);
				self::userWriteLog("uid:{$uid},checkEmailExist,line:" . __LINE__ . ",exist:" . ToolUtil::gbJsonEncode($exist));
				if (isset($exist['exist']) && $exist['exist'] != 0) //�µ�email�Ѿ���ռ��
				{
					self::userWriteLog("uid:{$uid},unset newInfo's email,line:" . __LINE__);
					unset($newInfo['email']);
				} else if ($userOldInfo['email'] == '') { //��email���ã��ϵ�emailΪ�գ�ֱ�Ӳ����µ�EMAIL
					self::userWriteLog("uid:{$uid},set needToinsertEmail=true,line:" . __LINE__ . ",needToinsertEmail:" . var_export($needToinsertEmail, true));
					$needToinsertEmail = true;
				} else //�ϵ�EMAIL��Ϊ�գ���Ҫ�ж��ϵ�email�Ƿ��ڰ�״̬
				{
// 					$oldEmailStatus = self::_getTTCInfo("IEmailLoginTTC", $userOldInfo['email'], array('uid'=> $uid), array('status'));
					$oldEmailStatus = self::getEmailLoginByEmail($userOldInfo['email'], $uid, true);
					self::userWriteLog("uid:{$uid},get old Email info,line:" . __LINE__ . ",oldEmailStatus:" . ToolUtil::gbJsonEncode($oldEmailStatus));
					if ($oldEmailStatus === false)
						return false;

					if (isset($oldEmailStatus[0])) {
						if ($oldEmailStatus[0]['status'] == $_EmailStat['bound']) {
							self::userWriteLog("uid:{$uid},unset newInfo's email,line:" . __LINE__);
							unset($newInfo['email']);
						} else {
							self::userWriteLog("uid:{$uid},set needTodeleteEmail and needToinsertEmail=true,line:" . __LINE__);
							$needTodeleteEmail = true;
							$needToinsertEmail = true;
						}
					} else {
						self::userWriteLog("uid:{$uid},set needToinsertEmail=true,line:" . __LINE__);
						$needToinsertEmail = true;
					}

				}
			}
		}

		global $_MobileStat;
		//����û���д��һ���µ�mobile��ַ
		if (isset($newInfo['mobile']) && $newInfo['mobile'] != '') {

			if ($newInfo['mobile'] == $userOldInfo['mobile']) {
				self::userWriteLog("uid:{$uid},unset newInfo's mobile,line:" . __LINE__);
				unset($newInfo['mobile']);
			} else {
				if ($userOldInfo['mobile'] == '') { //�ϵ�mobileΪ�գ�ֱ�Ӳ����µ�mobile
					self::userWriteLog("uid:{$uid},set needToinsertMobile=true,line:" . __LINE__ . ",needToinsertEmail:" . var_export($needToinsertMobile, true));
					$needToinsertMobile = true;
				} else //�ϵ�MOBILE��Ϊ�գ���Ҫ�ж��ϵ�MOBILE�Ƿ��ڰ�״̬
				{
// 					$oldMobileStatus = self::_getTTCInfo("ITelLoginTTC", $userOldInfo['mobile'], array('uid'=> $uid), array('status'));
					$oldMobileStatus = self::getTelLoginByMobile($userOldInfo['mobile'], $uid, true);
					self::userWriteLog("uid:{$uid},get old Tel info,line:" . __LINE__ . ",oldMobileStatus:" . ToolUtil::gbJsonEncode($oldMobileStatus));
					if ($oldMobileStatus === false)
						return false;

					if (isset($oldMobileStatus[0])) {
						if ($oldMobileStatus[0]['status'] == $_MobileStat['bound']) {
							self::userWriteLog("uid:{$uid},unset newInfo's mobile,line:" . __LINE__);
							unset($newInfo['mobile']);
						} else {
							self::userWriteLog("uid:{$uid},set needTodeleteMobile and needToinsertMobile=true,line:" . __LINE__);
							$needTodeleteMobile = true;
							$needToinsertMobile = true;
						}
					} else {
						self::userWriteLog("uid:{$uid},set needToinsertMobile=true,line:" . __LINE__);
						$needToinsertMobile = true;
					}

				}
			}
		}
		//����ͳһ�û��ӿ�˫д���⴦��
		if(isset($newInfo['exp_point']))
		{
			UserWg::updateUserExpWg($uid, $newInfo);
		}
		if(isset($newInfo['level']))
		{
			UserWg::updateUserLevelWg($uid, $newInfo);
		}
		//��ʼ�����û�����
		//��������
		$now = time();
		if (count($newInfo) == 0) {
			self::$errCode = 30;
			self::$errMsg = "���ύ����Ϣû�иı䣬�������";
			return true;
		}

		$newInfo['updatetime'] = $now;

		// ������¼��password
		$pass = "";
		if (isset($newInfo['pass'])) {
			$pass = $newInfo['pass'];
			unset($newInfo['pass']);
		}

		//������������û�����
		if (false === self::_getDB($uid, "users", $mysql, $index, __LINE__))
			return false;

		if (false === $mysql->execSql("begin")) {
			self::$errCode = $mysql->errCode;
			self::$errMsg = basename(__FILE__, "php") . " | " . __LINE__ . " start transaction failed! " . $mysql->errMsg;
			return false;
		}

		self::userWriteLog("uid:{$uid},start transaction");
		if (false === self::_update($uid, "t_users_", $mysql, $index, $newInfo, "uid=$uid", __LINE__))
			return false;

		if (true === $needTodeleteEmail) {
			if (false === self::_getDB2($userOldInfo['email'], "email_login", $mysql, $index, __FILE__))
				return false;

			if (false === self::_remove($uid, "t_email_login_", $mysql, $index, "email='{$userOldInfo['email']}' and uid=$uid", __LINE__))
				return false;

			self::userWriteLog("uid:{$uid},t_email_login_ remove,line:" . __LINE__ . ",index:" . ToolUtil::gbJsonEncode($index) . ",where email='{$userOldInfo['email']} and uid=$uid");
		}

		if (true === $needToinsertEmail) {
			$data = array('email'=> $newInfo['email'], 'uid'=> $uid, 'status'=> $_EmailStat['normal'], 'updatetime'=> $now);
			if (false === self::_getDB2($newInfo['email'], "email_login", $mysql, $index, __FILE__))
				return false;

			if (false === self::_insert($uid, "t_email_login_", $mysql, $index, $data, __LINE__)){
				if(self::$errCode == 10303){
					self::userWriteLog("uid:{$uid},t_email_login_ update,line:" . __LINE__ . ",index:" . ToolUtil::gbJsonEncode($index) . ",data:" . ToolUtil::gbJsonEncode($data));
					if (false === self::_update($uid, "t_email_login_", $mysql, $index, $data, "email='".$newInfo['email']."'", __LINE__))
						return false;
				}
// 				return false;
			}


			self::userWriteLog("uid:{$uid},t_email_login_ insert,line:" . __LINE__ . ",index:" . ToolUtil::gbJsonEncode($index) . ",data:" . ToolUtil::gbJsonEncode($data));

		}

		if (true === $needTodeleteMobile) {
			if (false === self::_getDB2($userOldInfo['mobile'], "tel_login", $mysql, $index, __FILE__))
				return false;

			if (false === self::_remove($uid, "t_tel_login_", $mysql, $index, "mobile='{$userOldInfo['mobile']}' and uid=$uid", __LINE__))
				return false;

			self::userWriteLog("uid:{$uid},t_tel_login_ remove,line:" . __LINE__ . ",index:" . ToolUtil::gbJsonEncode($index) . ",where mobile='{$userOldInfo['mobile']} and uid=$uid");

		}

		if (true === $needToinsertMobile) {

			$data = array('mobile'=> $newInfo['mobile'], 'uid'=> $uid, 'status'=> $_MobileStat['normal'], 'updatetime'=> $now);

			if (false === self::_getDB2($newInfo['mobile'], "tel_login", $mysql, $index, __FILE__))
				return false;

			$sql = "select * from t_tel_login_{$index['table']} where mobile='{$newInfo['mobile']}' and uid={$uid}";
			$ret = $mysql->getRows($sql);
			if (false === $ret) {
				self::$errCode = $mysql->errCode;
				self::$errMsg = basename(__FILE__) . ",line:" . __LINE__ . ", errMsg:" . $mysql->errMsg;
				return false;
			}

			if (count($ret) == 0) {
				if (false === self::_insert($uid, "t_tel_login_", $mysql, $index, $data, __LINE__))
					return false;

				self::userWriteLog("uid:{$uid},t_tel_login_ insert,line:" . __LINE__ . ",index:" . ToolUtil::gbJsonEncode($index) . ",data:" . ToolUtil::gbJsonEncode($data));

			} else {
				self::userWriteLog("uid:{$uid},t_tel_login_ insert duplicate key,line:" . __LINE__ . ",index:" . ToolUtil::gbJsonEncode($index) . ",data:" . ToolUtil::gbJsonEncode($ret));
				$needToinsertMobile = false;
			}

		}

		if (isset($newInfo['status'])) {

			$data = array('status'=> $newInfo['status'], 'updatetime'=> $now);
			if (false === self::_getDB2($userOldInfo['icsonid'], "icson_login", $mysql, $index, __FILE__))
				return false;

			if (false === self::_update($uid, "t_icson_login_", $mysql, $index, $data, "icsonid='{$userOldInfo['icsonid']}'", __LINE__))
				return false;

			self::userWriteLog("uid:{$uid},t_icson_login_ update,line:" . __LINE__ . ",index:" . ToolUtil::gbJsonEncode($index) . ",data:" . ToolUtil::gbJsonEncode($data));

		}

		// �����벻����
		if (!empty($pass)) {
			$pass_data = array('uid'=> $uid, 'createtime'=> $now, 'updatetime'=> $now, 'pass'=> '', 'password'=> md5($pass));
			if (false === self::_getDB($uid, "user_pass", $mysql, $index, __LINE__))
				return false;

			if (false === self::_update($uid, "t_user_pass_", $mysql, $index, $pass_data, "uid=$uid", __LINE__))
				return false;
			$newInfo['pass'] = $pass;

			self::userWriteLog("uid:{$uid},t_user_pass_ update,line:" . __LINE__ . ",index:" . ToolUtil::gbJsonEncode($index) . ",data��" . ToolUtil::gbJsonEncode($pass_data));

		}

		$data = array();
		$erpDb = ToolUtil::getMSDBObj('Customer');

		foreach (self::$WEB_ERP_PAIR_USER as $web => $erp) {
			if (isset($newInfo[$web])) {
				$data[$erp] = self::translate($web, $newInfo, $erpDb);
			}
		}

		unset($data['SysNo']);
		unset($data['Pwd']); //ERP������Ҫ�û�����
		$ret = $erpDb->update('Customer', $data, "SysNo=$uid");

		if (false === $ret) {
			self::$errCode = $erpDb->errCode;
			self::$errMsg = $erpDb->errMsg;
			$mysql->execSql("rollback");
			return false;
		}
		self::userWriteLog("uid:{$uid},t_user_pass_ update,line:" . __LINE__ . ",data:" . ToolUtil::gbJsonEncode($data));

		$ret = $mysql->execSql("commit");

		self::userWriteLog("uid:{$uid},commit,line:" . __LINE__ . ",commit result:" . ToolUtil::gbJsonEncode($ret));

		if ($needTodeleteEmail == true && !empty($userOldInfo['email'])) {
			self::_purgeData4StrV2("IEmailLoginTTC", $userOldInfo['email']);
			self::userWriteLog("uid:{$uid},purge IEmailLoginTTC key {$userOldInfo['email']}");

		}
		if ($needTodeleteMobile == true && !empty($userOldInfo['mobile'])) {
			self::_purgeData4StrV2("ITelLoginTTC", $userOldInfo['mobile']);
			self::userWriteLog("uid:{$uid},purge ITelLoginTTC key {$userOldInfo['mobile']}");
		}

		if (isset($newInfo['email'])) {
			self::_purgeData4StrV2("IEmailLoginTTC", $newInfo['email']);
			self::userWriteLog("uid:{$uid},purge IEmailLoginTTC key {$newInfo['email']}");
		}
		if ($needToinsertMobile && isset($newInfo['mobile'])) {
			self::_purgeData4StrV2("ITelLoginTTC", $newInfo['mobile']);
			self::userWriteLog("uid:{$uid},purge ITelLoginTTC key {$newInfo['mobile']}");
		}
		if ("" != $pass) {
			self::_purgeData4Int("IUserPassTTC", $uid);
			self::userWriteLog("uid:{$uid},purge IUserPassTTC");
		}
		self::_purgeData4Int("IUsersTTC", $uid);
		self::userWriteLog("uid:{$uid},purge IUsersTTC");
		//д��Ѹ�ɹ�д����
		UserWg::updateUserWg($uid, $newInfo);
		return true;
	}

	/*
	 public static function modifyQQAccount($old_, $new_)
	 {
		 global $_IcsonAccStat;
		 // get user id
		 $uid = 0;
		 $item = IIcsonLoginTTC::get($old_);
		 if (false === $item)
		 {
			 self::$errCode = IIcsonLoginTTC::$errCode;
			 self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[query IIcsonLoginTTC failed:" . IUsersTTC::$errMsg . "]";
			 return false;
		 }
		 else if (0 === count($item))
		 {
			 return true;
		 }
		 else
		 {
			 $uid = $item[0]['uid'];
		 }

		 // update new icson id on user table
		 $info['uid'] = $uid;
		 $info['icsonid'] = $new_;
		 $info['updatetime'] = time();
		 $ret = IUsersTTC::update($info);
		 if (false === $ret)
		 {
			 return false;
		 }

		 // insert the new icsonid into IcsonLogin table
		 $item = IIcsonLoginTTC::get($new_);
		 if (false === $item )
		 {
			 return false;
		 }
		 else if (0 === count($item))
		 {
			 $ret = IIcsonLoginTTC::insert(array('icsonid'=>$new_, 'uid'=> $uid, 'status'=>$_IcsonAccStat['normal'],'updatetime'=>time()));
			 if ($ret === false)
			 {
				 return false;
			 }
		 }

		 // update user info into ERP
		 $ret = IUserSyn::update($uid, array('icsonid' => $new_, 'updatetime' => time()));
		 if (false === $ret)
		 {
			 return false;
		 }

		 // delete the old icsonid from IcsonLogin table
		 $item = IIcsonLoginTTC::get($old_);
		 if (false === $item )
		 {
			 return false;
		 }
		 else if (1 === count($item))
		 {
			 $ret = IIcsonLoginTTC::remove($old_);
		 }

		 return $ret;
	 }
 */
	/*
	 * ��ȥĳ���û���Ϣ
	 */
	public static function getUserInfo($uid, $needPoint=false)
	{
		global $_EmailStat;
		global $_MobileStat;

		if ($uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "uid($uid) is invalid";
			return false;
		}

		//��ȥ��һ���û���Ϣ
		//$userInfo = self::_getTTCInfo("IUsersTTC", $uid);
		$userInfo = self::getUsersTTC($uid);
		if (false === $userInfo || count($userInfo) != 1) {
			if (count($userInfo) == 0) {
				self::$errCode = 67;
				self::$errMsg = 'user not exists';
				return false;
			}

			self::$errCode = IUsersTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "query $uid from mssql faild:" . IUsersTTC::$errMsg;
			return false;
		}

		$userInfo = $userInfo[0];
		$userInfo['bindEmail'] = 0;
		$userInfo['bindMobile'] = 0;
		if(self::ifInGray($uid)){
// 			$userInfo['point'] = UserPointWg::GetPointsAccount($uid);
			$userInfo['point'] = 0;
			if($needPoint || ToolUtil::is_mobile()){//���߻�����Ҫ��ȡ���ֵĵط����û��ֽӿ�
				$point = UserPointWg::GetPointsAccount($uid);
				if(!empty($point)){
					$userInfo['point'] = empty($point->dwTotalAvailablePoints) ? 0 : $point->dwTotalAvailablePoints;
					$userInfo['promotion_point'] = empty($point->dwPromotionPoints) ? 0 : $point->dwPromotionPoints;
					$userInfo['cash_point'] = empty($point->dwCashPoints) ? 0 : $point->dwCashPoints;
				}
			}
			if(!empty($userInfo['status_bits'][12])){
				$userInfo['bindEmail'] = 1;
			}
			if(!empty($userInfo['status_bits'][13])){
				$userInfo['bindMobile'] = 1;
			}
			
			$status_bits = 0;
			if(!empty($userInfo['status_bits'][8])){//�ձ���
				$status_bits |= 1;
			}
			if(!empty($userInfo['status_bits'][14])){//�Ƿ�����ֱ�־λ
				$status_bits |= 2;
			}
			if(!empty($userInfo['status_bits'][13])){//���ֻ�
				$status_bits |= 4;
			}
			if(!empty($userInfo['status_bits'][12])){//������
				$status_bits |= 8;
			}
			$userInfo['status_bits'] = $status_bits;
		}else{
			$userInfo['point'] = $userInfo['valid_point'];
			unset($userInfo['valid_point']);
		}


		global $_UserLevel;
		$level = empty($userInfo['level']) ? 0 : $userInfo['level'];
		if($level <= 6){
			$ul = $_UserLevel[$level];
			$userInfo['levelDesc'] = $ul['desc'];
			if($level < 6){
				$userInfo['nextLevel'] = $ul['endV'] + 1;
				$userInfo['nextLevelDesc'] = $_UserLevel[$level + 1]['desc'];
			}
		}
// 		foreach ($_UserLevel as $key => &$ul) {
// 			if ($userInfo['exp_point'] <= $ul['endV'] && $userInfo['exp_point'] >= $ul['startV']) {
// 				$userInfo['levelDesc'] = $ul['desc'];
// 				if ($key < 6) {
// 					$userInfo['nextLevel'] = $ul['endV'] + 1;
// 					$userInfo['nextLevelDesc'] = $_UserLevel[$key + 1]['desc'];
// 				}
// 				break;
// 			}
// 		}

		$now = time();
		if(!self::ifInGray($uid)){
			if ($userInfo['email'] != "" && $userInfo['email'] != NULL) {
				$item = self::_getTTCInfo("IEmailLoginTTC", $userInfo['email'], array('uid'=> $uid));
// 				$item = self::getEmailLoginByEmail($userInfo['email'], $uid, true);
					
				if (false === $item) {
					self::$errMsg = (basename(__FILE__, '.php') . " | Line:" . __LINE__ . "query [" . $userInfo['email'] . "] from MSSQL:" . IEmailLoginTTC::$errMsg);
					return false;
				} else if (count($item) == 0) {
					//�޸�����
					IEmailLoginTTC::insert(array('email'=> $userInfo['email'], 'uid'=> $uid, 'status'=> $_EmailStat['normal'], 'updatetime'=> $now));
					self::$errMsg = (basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[" . $userInfo['email'] . "] not exist in mssql");
				} else if ($item[0]['status'] == $_EmailStat['bound']) {
					$userInfo['bindEmail'] = 1;
				}
			}
			
			if ($userInfo['mobile'] != "" && $userInfo['mobile'] != NULL) {
				$item = self::_getTTCInfo("ITelLoginTTC", $userInfo['mobile'], array('uid'=> $uid));
// 				$item = self::getTelLoginByMobile($userInfo['mobile'], $uid, true);
				if (false === $item) {
					self::$errMsg = (basename(__FILE__, '.php') . " | Line:" . __LINE__ . "query [" . $userInfo['mobile'] . "] from mssql:" . ITelLoginTTC::$errMsg);
					return false;
				} else if (count($item) == 0) {
					//�޸�����
					//ITelLoginTTC::insert(array('mobile'=>$userInfo['mobile'], 'uid'=>$uid, 'status'=>$_MobileStat['normal'], 'updatetime'=>$now));
					self::$errMsg = (basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[" . $userInfo['mobile'] . "] from telTTC:not in ttc");
				} else if ($item[0]['status'] == $_MobileStat['bound']) {
					$userInfo['bindMobile'] = 1;
				}
			}
		}

		$openID = strpos($userInfo['icsonid'], QQ_ACCOUNT_PRE . '_') === 0 ? substr($userInfo['icsonid'], strlen(QQ_ACCOUNT_PRE) + 1) : '';
		$userInfo['openID'] = $openID;
		return $userInfo;
	}

	public static function getUserInfoAndExtension($uid)
	{
		return self::getUserInfo($uid);
	}

	public static function updateUserExtension($uid, $info)
	{
		$ret = true;
		//������
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[uid($uid) is invalid]";
			return false;
		}
		$check = false;
		$extension = array();
		if (isset($info['recomend_score'])) {
			$extension['recomend_score'] = $info['recomend_score'];
			$check = true;
		}
		if (isset($info['refer_uid'])) {
			$extension['refer_uid'] = $info['refer_uid'];
			$check = true;
		}
		if (isset($info['vip_rank'])) {
			$extension['vip_rank'] = $info['vip_rank'];
			$check = true;
		}
		if (isset($info['web_power_group'])) {
			$extension['web_power_group'] = $info['web_power_group'];
			$check = true;
		}

		if (true === $check) {
			if (false === self::_getDB($uid, "users", $mysql, $index, __LINE__))
				return false;

			if (false === self::_update($uid, "t_users_", $mysql, $index, $extension, "uid=$uid", __LINE__))
				return false;
		}

		self::_purgeData4Int("IUsersTTC", $uid);
		return $ret;
	}

	//��Ϊerpͬ���ã���ȡһ���û���Ϣ���ȼ�ʵ�֣���ͨ�߼����������getUserInfo( $uid )��
	public static function getUserInfos($uids)
	{
		$ret = self::_getTTCInfos("IUsersTTC", $uids);

		$emails = array();
		$mobiles = array();
		$userInfos = array();

		foreach ($ret as $user) {
			// ��ȡ��email��mobile
			if (!empty($user['email']))
				$emails[] = $user['email'];

			if (!empty($user['mobile']))
				$mobiles[] = $user['mobile'];

			// �ع�userInfos�Ľṹ����uidΪkey
			$userInfos[$user['uid']] = $user;
		}


		$ret = self::_getTTCInfos("IEmailLoginTTC", $emails);
		foreach ($ret as $user) {
			$userInfos[$user['uid']]['bindEmail'] = $user['status'];
		}

		$ret = self::_getTTCInfos("ITelLoginTTC", $mobiles);
		foreach ($ret as $user) {
			$userInfos[$user['uid']]['bindMobile'] = $user['status'];
		}

		foreach ($userInfos as $uid=> &$user) {
			// ��valid_point��ôΪpoint
			$user['point'] = $user['valid_point'];
			unset($user['valid_point']);

			// �����Ա�ȼ�
			global $_UserLevel;
			foreach ($_UserLevel as $key => &$ul) {
				if ($user['exp_point'] <= $ul['endV'] && $user['exp_point'] >= $ul['startV']) {
					$user['levelDesc'] = $ul['desc'];
					if ($key < 6) {
						$user['nextLevel'] = $ul['endV'] + 1;
						$user['nextLevelDesc'] = $_UserLevel[$key + 1]['desc'];
					}
					break;
				}
			}

			$openID = strpos($user['icsonid'], QQ_ACCOUNT_PRE . '_') === 0 ? substr($user['icsonid'], strlen(QQ_ACCOUNT_PRE) + 1) : '';
			$user['openID'] = $openID;
		}

		return $userInfos;
	}

	/**
	 * �û���email,�û���дemail��������߼��������������İ󶨣�����email���뷴���
	 * ����false������
	 * ����1 �� �����email�ѱ�ռ��
	 * ����2��    ���û��Ѿ����˸�email�������ٰ�
	 * ����3��    ���û��Ѿ���������email����Ҫ�Ƚ��
	 */
	public static function bindEmail($uid, $email)
	{
		global $_EmailStat;

		$ret = self::checkEmailAndUid($uid, $email);
		if (false === $ret) {
			return false;
		}
		//�ȿ�email�Ƿ��б����ʸ�

// 		$item = self::_getTTCInfo("IEmailLoginTTC", $email);
		$item = self::getEmailLoginByEmail($email, $uid);
		if ($item === false)
			return false;

		//�����email�Ѿ����˰���
		if (count($item) > 0 && ($item[0]['status'] == $_EmailStat['bound'])) {
			if ($item[0]['uid'] == $uid) //�Լ���
			{
				self::$errMsg = "���Ѿ��󶨸�Email";
				self::$errCode = 26;
				return false;
			} else {
				self::$errMsg = "��Email�Ѿ���ռ��";
				self::$errCode = 25;
				return false;
			}
		}

		//$email�а��ʸ�
// 		$userOldInfo = self::_getTTCInfo("IUsersTTC", $uid);
		$userOldInfo = self::getUsersTTC($uid);
		if (false === $userOldInfo || count($userOldInfo) != 1) {
			return false;
		}

		$now = time();
		$userOldInfo = $userOldInfo[0];
		//old info��Ϊ�� ��Ϊ ��ͬmail
		if ($userOldInfo['email'] != $email) {
			if ($userOldInfo['email'] != "" && $userOldInfo['email'] != NULL) {

// 				$item = self::_getTTCInfo("IEmailLoginTTC", $userOldInfo['email']);
				$item = self::getEmailLoginByEmail($userOldInfo['email'], $uid);
				if (false === $item) {
					return false;
				}
				if (count($item) != 0 && $item[0]['status'] == $_EmailStat['bound']) {
					self::$errMsg = "�û��Ѿ�����һ��Email�����Ƚ��";
					self::$errCode = 28;
					return false;
				}
			}
		}

		//����û���д����һ���µ�EMAIL
		if ($userOldInfo['email'] != $email) {

			if (false === self::_getDB($uid, "users", $mysql, $index, __LINE__))
				return false;

			$ret = $mysql->execSql("begin");
			if ($ret === false) {
				self::$errMsg = basename(__FILE__, 'php') . " | Line: " . __LINE__ . " start transaction error!" . $mysql->errMsg;
				return false;
			}

			$data = array('email'=> $email, 'updatetime'=> $now);
			if (false === self::_update($uid, "t_users_", $mysql, $index, $data, "uid=$uid", __LINE__))
				return false;

			if (false === self::_getDB2($email, "email_login", $mysql, $index, __FILE__))
				return;

			$data = array('email'=> $email, 'uid'=> $uid, 'status'=> $_EmailStat['normal'], 'updatetime'=> $now);
			if (false === self::_insert($uid, "t_email_login_", $mysql, $index, $data, __LINE__)){
				if(self::$errCode == 10303){
					if (false === self::_update($uid, "t_email_login_", $mysql, $index, $data, "email='".$email."'", __LINE__))
						return false;
				}
			}
// 				return;

			if ($userOldInfo['email'] != '') {
				if (false === self::_getDB2($userOldInfo['email'], "email_login", $mysql, $index, __FILE__))
					return;

				if (false === self::_remove($uid, "t_email_login_", $mysql, $index, "uid=$uid and email='{$userOldInfo['email']}'", __LINE__))
					return;
			}

			$erpDb = ToolUtil::getMSDBObj('Customer');
			if (false === $erpDb) {
				self::$errCode = ToolUtil::$errCode;
				self::$errMsg = ToolUtil::$errMsg;
				$mysql->execSql("rollback");
				return false;
			}

			$ret = $erpDb->update("Customer", array('SysNo'=> $uid, 'Email'=> $email, 'EmailStatus'=> $_EmailStat['normal'], 'rowModifyDate'=> date('Y-m-d H:i:s')), "SysNo=$uid");
			if (false === $ret) {
				self::$errCode = $erpDb->errCode;
				self::$errMsg = $erpDb->errMsg;
				$sql = "rollback";
				$mysql->execSql($sql);
				return false;
			}

			$mysql->execSql("commit");

			self::_purgeData4StrV2("IEmailLoginTTC", $userOldInfo['email']);
			self::_purgeData4StrV2("IEmailLoginTTC", $email);
			self::_purgeData4Int("IUsersTTC", $uid);
			
			$newInfo = array('email'=>$email);
			UserWg::updateUserWg($uid, $newInfo);

		}
		//�����ʼ�,�ʼ�EMAIL�а���get����Ϊ��code=xxxxxx
		$code = IVerify::getEmailVerifyCode($uid, $email);
		if (false === $code) {
			self::$errCode = IVerify::$errCode;
			self::$errMsg = IVerify::$errMsg;
			return false;
		}
		$url = "http://base.51buy.com/index.php?mod=user&act=validateemail&uid=$uid&email=$email&code=$code";
		Logger::info("bind sendEmail url:".$url);
		$ret = IMessage::sendEmail($email, "������", $url);
		if (false === $ret) {
			self::$errCode = IMessage::$errCode;
			self::$errMsg = IMessage::$errMsg;
			return false;
		}
		return $url;
	}

	/**
	 * ֱ���û���email,
	 * ����false������
	 * ����1 �� �����email�ѱ�ռ��
	 * ����2��    ���û��Ѿ����˸�email�������ٰ�
	 * ����3��    ���û��Ѿ���������email����Ҫ�Ƚ��
	 */

	//modify by april 6.1
	public static function bindEmailWithoutValid($uid, $email)
	{
		global $_EmailStat;
		$ret = self::checkEmailAndUid($uid, $email);
		if (false === $ret) {
			return false;
		}

		//�ȿ�email�Ƿ��б����ʸ�
// 		$item = self::_getTTCInfo("IEmailLoginTTC", $email);
		$item = self::getEmailLoginByEmail($email, $uid);
		if ($item === false) {
			return false;
		}

		//�����email�Ѿ����˰���
		if (count($item) > 0) {
			if ($item[0]['uid'] == $uid) //�Լ���
			{
				if ($item[0]['status'] == $_EmailStat['bound']) {
					return true; // û��return true������û�����󡱹��������
				}
			} else {
				self::$errMsg = "��Email�Ѿ���ռ��";
				self::$errCode = 25;
				return false;
			}
		}

		//$email�а��ʸ�
// 		$userOldInfo = self::_getTTCInfo("IUsersTTC", $uid);
		$userOldInfo = self::getUsersTTC($uid);
		if (false === $userOldInfo || count($userOldInfo) != 1) {
			return false;
		}

		$now = time();
		$userOldInfo = $userOldInfo[0];


		//old info��Ϊ�� ��Ϊ ��ͬmail
		if (false === self::_getDB($uid, "users", $mysql, $index, __LINE__))
			return false;

		if (false === self::_startTrans($mysql, __LINE__))
			return false;


		if ($userOldInfo['email'] != $email) {
			$data = array('email'=> $email, 'uid'=> $uid, 'status'=> $_EmailStat['bound'], 'updatetime'=> $now);
			if (false === self::_getDB2($email, "email_login", $mysql, $index, __FILE__))
				return false;

			$emailInfo = self::getEmailLoginByEmail($email, $uid);
			if(false===$emailInfo){
				self::$errCode = 29;
				self::$errMsg = "���䷴��ʧ��";
				return false;
			}
			if(count($emailInfo)==1){
				if (false === self::_update($uid, "t_email_login_", $mysql, $index, $data, "email='$email' and uid=$uid", __LINE__)){
					return false;
				}
			}
			else if(count($emailInfo)==0){
				if (false === self::_insert($uid, "t_email_login_", $mysql, $index, $data, __LINE__)){
					if(self::$errCode == 10303){
						if (false === self::_update($uid, "t_email_login_", $mysql, $index, $data, "email='".$email."'", __LINE__))
							return false;
					}
// 					return false;
				}
			}

			if ($userOldInfo['email'] != '') {
				if (false === self::_getDB2($userOldInfo['email'], "email_login", $mysql, $index, __FILE__))
					return false;

				if (false === self::_remove($uid, "t_email_login_", $mysql, $index, "uid=$uid and email='{$userOldInfo['email']}'", __LINE__))
					return false;
			}

			$data = array('email'=> $email, 'updatetime'=> $now);
			if (false === self::_getDB($uid, "users", $mysql, $index, __LINE__))
				return false;

			if (false === self::_update($uid, "t_users_", $mysql, $index, $data, "uid=$uid", __LINE__))
				return false;
		} else {

			$data = array('status'=> $_EmailStat['bound'], 'updatetime'=> $now);
			if (false === self::_getDB2($email, "email_login", $mysql, $index, __FILE__))
				return false;

			if (false === self::_update($uid, "t_email_login_", $mysql, $index, $data, "uid=$uid", __LINE__))
				return false;
		}

		$erpDb = ToolUtil::getMSDBObj('Customer');
		if (false === $erpDb) {
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = ToolUtil::$errMsg;
			$sql = "rollback";
			$mysql->execSql($sql);
			return false;
		}

		$ret = $erpDb->update("Customer", array('EmailStatus'=> $_EmailStat['bound'], 'rowModifyDate'=> date('Y-m-d H:i:s')), "SysNo=$uid");
		if (false === $ret) {
			self::$errCode = $erpDb->errCode;
			self::$errMsg = $erpDb->errMsg;
			$sql = "rollback";
			$mysql->execSql($sql);
			return false;
		}
		$sql = "commit";
		$mysql->execSql($sql);

		self::_purgeData4StrV2("IEmailLoginTTC", $userOldInfo['email']);
		self::_purgeData4StrV2("IEmailLoginTTC", $email);
		self::_purgeData4Int("IUsersTTC", $uid);
		//���������û�ͳһ�ӿڰ�����
		UserWg::bindMobileOrEmailWg($uid, 1, $email);
		return true;

	}

	/**
	 * ������email���󶨺��û�������email��¼
	 * ����false������
	 * ����true���ɹ�
	 */

	public static function realBindEmail($code)
	{
		global $_EmailStat;

		if (strlen($code) != 16) {
			self::$errCode = -10001;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "code($code) is invalid";
			return false;
		}

		$uid = hexdec(substr($code, 0, 8));
		$code = substr($code, 8);

		if ($uid <= 0) {
			self::$errCode = -10001;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "uid($uid) is invalid";
			return false;
		}


// 		$userInfo = self::_getTTCInfo("IUsersTTC", $uid);
		$userInfo = self::getUsersTTC($uid);
		if (false === $userInfo || count($userInfo) != 1) {
			self::$errCode = 24;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "query $uid from userTTC faild:IUsersTTC::errCode";
			return false;
		}

		$userInfo = $userInfo[0];
		$email = $userInfo['email'];
		if ("" == $email) {
			self::$errCode = 25;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "uid($uid)'s email is null";
			return false;
		}

		//��֤code�Ƿ���ȷ
		$ret = IVerify::checkEmailVerifyCode($uid, $code, $email);
		if (false === $ret) {
			self::$errCode = IVerify::$errCode;
			self::$errMsg = IVerify::$errMsg;
			return false;
		}

// 		$item = self::_getTTCInfo("IEmailLoginTTC", $email);
		$item = self::getEmailLoginByEmail($email, $uid);
		if (false === $item) {
			return false;
		}
		
		if(!empty($item)){
			if ($item[0]['uid'] != $uid) {
				self::$errCode = -29;
				self::$errMsg = "$email is not belong to $uid";
				return false;
			} else if ($item[0]['status'] == $_EmailStat['bound']) {
				return true;
			}
		}


		// ������
		if (false === self::_getDB2($email, "email_login", $mysql, $index, __FILE__))
			return false;

		if (false === self::_startTrans($mysql, __LINE__))
			return false;

		$data = array('uid'=>$uid, 'status'=> $_EmailStat['bound'], 'updatetime'=> time());

		if (false === self::_update($uid, "t_email_login_", $mysql, $index, $data, "email='{$userInfo['email']}'", __LINE__))
			return false;


		$erpDb = ToolUtil::getMSDBObj('Customer');
		if (false === $erpDb) {
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = ToolUtil::$errMsg;
			$sql = "rollback";
			$mysql->execSql($sql);
			return false;
		}

		$ret = $erpDb->update("Customer", array('EmailStatus'=> $_EmailStat['bound'], 'rowModifyDate'=> date('Y-m-d H:i:s')), "SysNo=$uid");
		if (false === $ret) {
			self::$errCode = $erpDb->errCode;
			self::$errMsg = $erpDb->errMsg;
			$sql = "rollback";
			$mysql->execSql($sql);
			return false;
		}

		$sql = "commit";
		$mysql->execSql($sql);

		self::_purgeData4StrV2("IEmailLoginTTC", $email);

		//���������û�ͳһ�ӿڰ�����
		UserWg::bindMobileOrEmailWg($uid, 1, $email);
		return true;
	}

	/**
	 * �����email
	 */
	public static function unBindEmail($uid, $email)
	{
		global $_EmailStat;

		$checkRet = self::checkEmailAndUid($uid, $email);
		if (false === $checkRet) {
			return $checkRet;
		}

		//�ȿ�email�Ƿ��б����ʸ�
// 		$item = self::_getTTCInfo("IEmailLoginTTC", $email);
		$item = self::getEmailLoginByEmail($email, $uid);
		if (false === $item) {
			self::$errCode = IEmailLoginTTC::$errCode;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "query [" . $email . "] from mssql:" . IEmailLoginTTC::$errMsg;
			return false;
		}
		if (count($item) == 0 // ������û�а󶨹��û�
			|| $item[0]['uid'] != $uid
		) // ���û����Email������Ӧ
		{
			//�����Լ��󶨵�����
			self::$errMsg = "���û����Email��û�а󶨹�";
			self::$errCode = 25;
			return false;
		} else if ($item[0]['status'] == $_EmailStat['unbound']) //��״̬Ϊunbound
		{
			return true;
		}
		$userOldInfo = $item[0];

		if (false === self::_getDB2($email, "email_login", $mysql, $index, __FILE__))
			return false;

		if (false === self::_startTrans($mysql, __LINE__))
			return false;

		$data = array('status'=> $_EmailStat['unbound']);
		if (false === self::_update($uid, "t_email_login_", $mysql, $index, $data, "uid=$uid and email='$email'", __LINE__))
			return false;

		$erpDb = ToolUtil::getMSDBObj('Customer');
		if (false === $erpDb) {
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = ToolUtil::$errMsg;
			$sql = "rollback";
			$mysql->execSql($sql);
			return false;
		}

		$ret = $erpDb->update("Customer", array('EmailStatus'=> $_EmailStat['unbound'], 'rowModifyDate'=> date('Y-m-d H:i:s')), "SysNo=$uid and Email='$email'");
		if (false === $ret) {
			self::$errCode = $erpDb->errCode;
			self::$errMsg = $erpDb->errMsg;
			$sql = "rollback";
			$mysql->execSql($sql);
			return false;
		}

		$sql = "commit";
		$mysql->execSql($sql);

		self::_purgeData4StrV2("IEmailLoginTTC", $email);
		//��Ѹ�ɹ��󣬵��������û�ͳһ�ӿڽ���û�
		UserWg::unbindMobileOrEmailWg($uid, 1, $email);
		return true;
	}


	/**
	 * �û����ֻ�,�û���д�ֻ���������߼��������������İ󶨣������ֻ����뷴���
	 * ����false������
	 * ����1���ֻ��ű�ռ��
	 * ����2����uid���˸��ֻ�
	 * ����3����uid���������ֻ�
	 * ����4�����ֻ��Ѿ�����󶨣�����û�г���һ����ʱ�䣬�����ٰ���ͬһ���˺���
	 * ����true���ɹ�
	 * allenzhou �½ӿ� ��ǰ̨��վʹ�� 2012-11-24
	 */
	public static function checkbindMobile($uid, $mobile)
	{
		global $_MobileStat;

		$ret = self::checkMobileAndUid($uid, $mobile);
		if (false === $ret) {
			return false;
		}

		//�ȿ�MOBILE�Ƿ��б����ʸ�
// 		$item = self::_getTTCInfo("ITelLoginTTC", $mobile);
		$item = self::getTelLoginByMobile($mobile, $uid);
		if (false === $item) {
			return false;
		}

		$boundUid = 0;
		$unBoundTime = 0;
		$unvalid_bound_uid = 0;
		$uid_have_this_mobile = false;
		foreach ($item as $it) {
			if ($it['status'] == $_MobileStat['bound']) {
				$boundUid = $it['uid'];
			}
			if ($it['status'] == $_MobileStat['unbound'] && $it['updatetime'] > $unBoundTime) {
				$unBoundTime = $it['updatetime'];
				$unvalid_bound_uid = $it['uid'];
			}
			if ($it['uid'] == $uid) {
				$uid_not_have_this_mobile = true;
			}
		}
		//�����MOBILE�Ѿ����˰���
		if ($boundUid == $uid) { //���Լ�
			return true;
		} else if ($boundUid > 0) {
			self::$errMsg = "���ֻ������Ѿ���ռ��";
			self::$errCode = 30;
			return false;
		}
// 		$userOldInfo = self::_getTTCInfo("IUsersTTC", $uid);
		$userOldInfo = self::getUsersTTC($uid);
		if (false === $userOldInfo || count($userOldInfo) != 1) {
			return false;
		}

		$now = time();
		$userOldInfo = $userOldInfo[0];

		$item = array();
		if ($userOldInfo['mobile'] != "" && $userOldInfo['mobile'] != NULL) {
// 			$item = self::_getTTCInfo("ITelLoginTTC", $userOldInfo['mobile'], array('uid'=> $uid));
			$item = self::getTelLoginByMobile($userOldInfo['mobile'], $uid, true);
			if ($item === false) {
				return false;
			}
		}

		//mobile�а��ʸ�
		//old info��Ϊ�� ��Ϊ ��ͬmobile
		if ($userOldInfo['mobile'] != $mobile) {
			if ($userOldInfo['mobile'] != "" && $userOldInfo['mobile'] != NULL) {
				if (count($item) != 0 && $item[0]['status'] == $_MobileStat['bound']) {
					self::$errMsg = "���Ѿ�����һ���ֻ������Ƚ��";
					self::$errCode = 30;
					return false;
				}
			}
		}
		if ($now - $unBoundTime < MOBILE_UNBIND_INTERVAL) {
			self::$errMsg = "����󶨺��" . intval(MOBILE_UNBIND_INTERVAL / 3600 / 24) . "���ڲ������°�ͬһ���ֻ���";
			self::$errCode = 30;
			return false;
		} else {
			ITelLoginTTC::remove($mobile, array('uid' => $unvalid_bound_uid));
		}
		//����û���д����һ���µ�mobile
		if ($userOldInfo['mobile'] != $mobile || !$uid_have_this_mobile) {
			if (false === self::_getDB($uid, "users", $mysql, $index, __LINE__)) {
				return false;
			}

			if (false === self::_startTrans($mysql, __LINE__)) {
				return false;
			}

			$data = array('mobile'=> $mobile, 'updatetime'=> $now);
			if (false === self::_update($uid, "t_users_", $mysql, $index, $data, "uid=$uid", __LINE__)) {
				return false;
			}

			if (false === self::_getDB2($mobile, "tel_login", $mysql, $index, __FILE__)) {
				return false;
			}

			$data = array('mobile'=> $mobile, 'uid'=> $uid, 'status'=> $_MobileStat['normal'], 'updatetime'=> $now);
			//$sql = "select * from t_tel_login_{$index['table']} where mobile='{$mobile}' and uid={$uid}";
			//$ret = $mysql->getRows($sql);
			//if(false === $ret)
			//{
			//	self::$errCode = $mysql->errCode;
			//	self::$errMsg = basename(__FILE__) . ",line:". __LINE__.", errMsg:" . $mysql->errMsg;
			//	return false;
			//}

			//if (false === self::_insert($uid, "t_tel_login_", $mysql, $index, $data,__LINE__)){
			//	return false;
			//}
			if (!$uid_have_this_mobile) {
				$tel_data = array('mobile'=> $mobile, 'uid'=> $uid, 'status'=> $_MobileStat['normal'], 'updatetime'=> $now);
				$add_ret = ITelLoginTTC::insert($tel_data);
				if (!$add_ret) {
					$delete_sql = "delete from t_tel_login_{$index['table']} where mobile='{$mobile}' and uid={$uid}";
					$del_ret = $mysql->execSql($delete_sql);
					$mysql->execSql('commit');
					self::_purgeData4StrV2("ITelLoginTTC", $mobile);
					//self::_remove($uid, "t_tel_login_", $mysql, $index, "mobile='{$mobile}' AND uid={$uid}", __LINE__);
					$add_ret = ITelLoginTTC::insert($tel_data);
					if (!$add_ret) {
						Logger::err('insert ITelLoginTTC ttc failed,code:' . ITelLoginTTC::$errCode . ',msg:' . ITelLoginTTC::$errMsg);
						return false;
					}
				}
				//self::userWriteLog("uid:{$uid},t_tel_login_ insert,line:".__LINE__.",index:".ToolUtil::gbJsonEncode($index).",data:".ToolUtil::gbJsonEncode($data));
			}
			$erpDb = ToolUtil::getMSDBObj('Customer');
			if (false === $erpDb) {
				self::$errCode = ToolUtil::$errCode;
				self::$errMsg = ToolUtil::$errMsg;
				$sql = "rollback";
				$mysql->execSql($sql);
				return false;
			}
			$ret = $erpDb->update("Customer", array('CellPhone'=> $mobile, 'rowModifyDate'=> date('Y-m-d H:i:s')), "SysNo=$uid");
			if (false === $ret) {
				self::$errCode = $erpDb->errCode;
				self::$errMsg = $erpDb->errMsg;
				$sql = "rollback";
				$mysql->execSql($sql);
				return false;
			}

			$mysql->execSql("commit");

			//self::_purgeData4Str("ITelLoginTTC", $mobile);
			//self::_purgeData4Str("ITelLoginTTC", $userOldInfo['mobile']);
			//self::_purgeData4Int("IUsersTTC", $uid);
			//��purge���ݵ�ʱ�����첽����,���Բ���purge���ݺ�����getTTC,����Ҫֱ��updateTTC

			$ret = IUsersTTC::update(array('uid' => $uid, 'mobile' => $mobile));
			if (!$ret) {
				Logger::err('update IUsersTTC ttc failed,msg:' . IUsersTTC::$errMsg);
			}
			
			$newInfo = array('mobile' => $mobile);
			UserWg::updateUserWg($uid, $newInfo);
		}

		return true;
	}


	/**
	 * �������ֻ����󶨺��û��������ֻ���¼
	 * allenzhou �½ӿ� ��ǰ̨��վʹ�� 2012-11-24
	 */
	public static function webBindMobile($uid, $mobile, $code, $need=true)
	{
		$bindMobile = self::checkbindMobile($uid, $mobile);
		if ($bindMobile == false) {
			return false;
		}

		global $_MobileStat;
		$now = time();

// 		$userInfo = self::_getTTCInfo("IUsersTTC", $uid);
		$userInfo = self::getUsersTTC($uid);
		if (false === $userInfo || count($userInfo) != 1)
			return false;


		$userInfo = $userInfo[0];
		if ("" == $userInfo['mobile'] || $mobile != $userInfo['mobile']) {
			self::$errCode = 25;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "uid($uid)'s mobile is null or not match";
			return false;
		}

// 		$item = self::_getTTCInfo("ITelLoginTTC", $mobile);
		$item = self::getTelLoginByMobile($mobile, $uid);
		if (false === $item)
			return false;
		$uidExist = true;
		if(!empty($item)){
			$uidExist = false;
			$boundUid = 0;
			foreach ($item as $i) {
				if ($i['uid'] == $uid) {
					$uidExist = true;
				}
				if ($i['status'] == $_MobileStat['bound']) {
					$boundUid = $i['uid'];
				}
			}
		}

		//�Ѿ��ǰ�״̬
		if ($uidExist === false) {
			self::$errCode = -30;
			self::$errMsg = "$mobile is not belong to $uid";
			return false;
		} else if ($boundUid == $uid) {
			return true;
		} else if ($boundUid > 0) {
			self::$errCode = -30;
			self::$errMsg = "$mobile is not bound to $boundUid already, can not bound to $uid";
			return false;
		}
		//��֤code�Ƿ���ȷ
		if($need)
		{
			$ret = IVerify::checkMobileVerifyCode($uid, $code, $userInfo['mobile']);
			if (false === $ret) {
				self::$errCode = IVerify::$errCode;
				self::$errMsg = IVerify::$errMsg;
				return false;
			}
		}

		if (false === self::_getDB2($userInfo['mobile'], "tel_login", $mysql, $index, __FILE__))
			return false;

		if (false === self::_startTrans($mysql, __LINE__))
			return false;

		$data = array('status'=> $_MobileStat['bound'], 'updatetime'=> $now);
		if (false === self::_update($uid, "t_tel_login_", $mysql, $index, $data, "mobile='{$userInfo['mobile']}' and uid=$uid", __LINE__))
			return false;

		$erpDb = ToolUtil::getMSDBObj('Customer');
		if (false === $erpDb) {
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = ToolUtil::$errMsg;
			$sql = "rollback";
			$mysql->execSql($sql);
			return false;
		}

		$ret = $erpDb->update("Customer", array('CellPhoneStatus'=> $_MobileStat['bound'], 'rowModifyDate'=> date('Y-m-d H:i:s')), "SysNo=$uid");
		if (false === $ret) {
			self::$errCode = $erpDb->errCode;
			self::$errMsg = $erpDb->errMsg;
			$sql = "rollback";
			$mysql->execSql($sql);
			return false;
		}

		$sql = "commit";
		$mysql->execSql($sql);
		Logger::info("Bind mobile, update tel_login. mobile: $mobile, uid: $uid, status: {$_MobileStat['bound']}, updatetime:$now");
		
		self::_purgeData4StrV2("ITelLoginTTC", $userInfo['mobile']);

		//��Ѹ��󶨳ɹ���������ͳһ��
		UserWg::bindMobileOrEmailWg($uid, 2, $mobile);

		return true;
	}


	/**
	 * �û����ֻ�,�û���д�ֻ���������߼��������������İ󶨣������ֻ����뷴���
	 * ����false������
	 * ����1���ֻ��ű�ռ��
	 * ����2����uid���˸��ֻ�
	 * ����3����uid���������ֻ�
	 * ����4�����ֻ��Ѿ�����󶨣�����û�г���һ����ʱ�䣬�����ٰ���ͬһ���˺���
	 * ����true���ɹ�
	 */
	public static function bindMobile($uid, $mobile)
	{
		global $_MobileStat;

		$ret = self::checkMobileAndUid($uid, $mobile);
		if (false === $ret) {
			return false;
		}

		//�ȿ�MOBILE�Ƿ��б����ʸ�
// 		$item = self::_getTTCInfo("ITelLoginTTC", $mobile);
		$item = self::getTelLoginByMobile($mobile, $uid);

		if (false === $item) {
			return false;
		}

		$boundUid = 0;
		$unBoundTime = 0;
		$unvalid_bound_uid = 0;
		foreach ($item as $it) {
			if ($it['status'] == $_MobileStat['bound']) {
				$boundUid = $it['uid'];
			}
			if ($it['status'] == $_MobileStat['unbound'] && $it['updatetime'] > $unBoundTime) {
				$unBoundTime = $it['updatetime'];
				$unvalid_bound_uid = $it['uid'];
			}
		}

		//�����MOBILE�Ѿ����˰���
		if ($boundUid == $uid) { //���Լ�
			return true;
		} else if ($boundUid > 0) {
			self::$errMsg = "���ֻ������Ѿ���ռ��";
			self::$errCode = 30;
			return false;
		}

// 		$userOldInfo = self::_getTTCInfo("IUsersTTC", $uid);
		$userOldInfo = self::getUsersTTC($uid);
		if (false === $userOldInfo || count($userOldInfo) != 1) {
			return false;
		}

		$now = time();
		$userOldInfo = $userOldInfo[0];

		$item = array();
		if ($userOldInfo['mobile'] != "" && $userOldInfo['mobile'] != NULL) {
// 			$item = self::_getTTCInfo("ITelLoginTTC", $userOldInfo['mobile'], array('uid'=> $uid));
			$item = self::getTelLoginByMobile($userOldInfo['mobile'], $uid, true);
			if ($item === false) {
				return false;
			}
		}

		//mobile�а��ʸ�
		//old info��Ϊ�� ��Ϊ ��ͬmobile
		if ($userOldInfo['mobile'] != $mobile) {
			if ($userOldInfo['mobile'] != "" && $userOldInfo['mobile'] != NULL) {
				if (count($item) != 0 && $item[0]['status'] == $_MobileStat['bound']) {
					self::$errMsg = "���Ѿ�����һ���ֻ������Ƚ��";
					self::$errCode = 30;
					return false;
				}
			}
		}
		if ($now - $unBoundTime < MOBILE_UNBIND_INTERVAL) {
			self::$errMsg = "����󶨺��" . intval(MOBILE_UNBIND_INTERVAL / 3600 / 24) . "���ڲ������°�ͬһ���ֻ���";
			self::$errCode = 30;
			return false;
		} else {
			ITelLoginTTC::remove($mobile, array('uid' => $unvalid_bound_uid));
		}

		$limited = IFreqLimit::checkAndAdd(substr($mobile, 2), 1);
		if ($limited > 0) {
			self::$errMsg = "ÿ���ֻ���24Сʱ�ڽ��ܳ��԰�5��";
			self::$errCode = 30;
			return false;
		}

		//����û���д����һ���µ�mobile
		if ($userOldInfo['mobile'] != $mobile) {

			if (false === self::_getDB($uid, "users", $mysql, $index, __LINE__)) {
				return false;
			}

			if (false === self::_startTrans($mysql, __LINE__)) {
				return false;
			}

			$data = array('mobile'=> $mobile, 'updatetime'=> $now);
			if (false === self::_update($uid, "t_users_", $mysql, $index, $data, "uid=$uid", __LINE__)) {
				return false;
			}

			if (false === self::_getDB2($mobile, "tel_login", $mysql, $index, __FILE__)) {
				return false;
			}

			$data = array('mobile'=> $mobile, 'uid'=> $uid, 'status'=> $_MobileStat['normal'], 'updatetime'=> $now);
			$sql = "select * from t_tel_login_{$index['table']} where mobile='{$mobile}' and uid={$uid}";
			$ret = $mysql->getRows($sql);
			if (false === $ret) {
				self::$errCode = $mysql->errCode;
				self::$errMsg = basename(__FILE__) . ",line:" . __LINE__ . ", errMsg:" . $mysql->errMsg;
				return false;
			}

			if (count($ret) == 0) {
				if (false === self::_insert($uid, "t_tel_login_", $mysql, $index, $data, __LINE__)) {
					return false;
				}
				self::userWriteLog("uid:{$uid},t_tel_login_ insert,line:" . __LINE__ . ",index:" . ToolUtil::gbJsonEncode($index) . ",data:" . ToolUtil::gbJsonEncode($data));
			} else {
				self::userWriteLog("uid:{$uid},t_tel_login_ insert duplicate key,line:" . __LINE__ . ",index:" . ToolUtil::gbJsonEncode($index) . ",data:" . ToolUtil::gbJsonEncode($ret));
			}

			/*if ($userOldInfo['mobile'] != '') {
				if ( false === self::_getDB2($userOldInfo['mobile'],"tel_login",$mysql,$index, __FILE__) ){
					return false;
				}
				if ( false === self::_remove($uid,"t_tel_login_",$mysql,$index,"uid=$uid and mobile='{$userOldInfo['mobile']}'",__LINE__) ){
					return false;
				}
			}*/

			$erpDb = ToolUtil::getMSDBObj('Customer');
			if (false === $erpDb) {
				self::$errCode = ToolUtil::$errCode;
				self::$errMsg = ToolUtil::$errMsg;
				$sql = "rollback";
				$mysql->execSql($sql);
				return false;
			}

			$ret = $erpDb->update("Customer", array('CellPhone'=> $mobile, 'rowModifyDate'=> date('Y-m-d H:i:s')), "SysNo=$uid");
			if (false === $ret) {
				self::$errCode = $erpDb->errCode;
				self::$errMsg = $erpDb->errMsg;
				$sql = "rollback";
				$mysql->execSql($sql);
				return false;
			}

			$mysql->execSql("commit");

			self::_purgeData4StrV2("ITelLoginTTC", $mobile);
			self::_purgeData4StrV2("ITelLoginTTC", $userOldInfo['mobile']);
			self::_purgeData4Int("IUsersTTC", $uid);
		}

		// ���Ͷ���
		$code = IVerify::getMobileVerifyCode($uid, $mobile);
		if (false === $code) {
			self::$errCode = IVerify::$errCode;
			self::$errMsg = IVerify::$errMsg;
			return false;
		}
		//$ret = true;
		$ret = IMessage::sendSMSMessage($mobile, "������Ѹ�����ֻ�����֤��Ϊ$code");
		if (false === $ret) {
			self::$errCode = IMessage::$errCode;
			self::$errMsg = IMessage::$errMsg;
			return false;
		}
		return true;

	}

	/**
	 * �û����ֻ�,�û���д�ֻ���������߼��������������İ󶨣������ֻ����뷴���
	 * ����false������
	 * ����1���ֻ��ű�ռ��
	 * ����2����uid���˸��ֻ�
	 * ����3����uid���������ֻ�
	 * ����4�����ֻ��Ѿ�����󶨣�����û�г���һ����ʱ�䣬�����ٰ���ͬһ���˺���
	 * ����true���ɹ�

	 */

	//modify by april 6.1
	public static function bindMobileWithoutValid($uid, $mobile)
	{
		global $_MobileStat;

		$ret = self::checkMobileAndUid($uid, $mobile);
		if (false === $ret) {
			return false;
		}

		//�ȿ�mobile�Ƿ��б����ʸ�
// 		$item = self::_getTTCInfo("ITelLoginTTC", $mobile, array('status'=> $_MobileStat['bound']));
		$item = self::getTelLoginByMobile($mobile, $uid, false, true);
		if (false === $item)
			return false;

		//�����mobile�Ѿ����˰���
		if (count($item) > 0) {
			if ($item[0]['uid'] == $uid) //�Լ���
			{
				return true;
			} else {
				self::$errMsg = "���ֻ������Ѿ���ռ��";
				self::$errCode = 30;
				return false;
			}
		}

// 		$userOldInfo = self::_getTTCInfo("IUsersTTC", $uid);
		$userOldInfo = self::getUsersTTC($uid);
		if (false === $userOldInfo || count($userOldInfo) != 1) {
			self::$errCode = 24;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "query $uid from mssql" . IUsersTTC::$errMsg;
			return false;
		}

		$now = time();
		$userOldInfo = $userOldInfo[0];

		//$email�а��ʸ�
		//old info��Ϊ�� ��Ϊ ��ͬmail
		if (false === self::_getDB($uid, "users", $mysql, $index, __LINE__))
			return false;

		if (false === self::_startTrans($mysql, __LINE__))
			return false;

		if ($userOldInfo['mobile'] != $mobile) {

			if (false === self::_getDB2($mobile, "tel_login", $mysql, $index, __FILE__))
				return false;

			//�ж���mobile�Ƿ���ڣ���ֹinsert����
// 			$mobileInfo = self::_getTTCInfo("ITelLoginTTC", $mobile, array('uid'=>$uid));
			$mobileInfo = self::getTelLoginByMobile($mobile, $uid, true);
			if(false===$mobileInfo){
				self::$errCode = 27;
				self::$errMsg = "�ֻ��ŷ���ʧ��";
				return false;
			}
			if(count($mobileInfo)==1){
				$data = array('mobile'=> $mobile, 'uid'=> $uid, 'status'=> $_MobileStat['bound'], 'updatetime'=> $now);
				if (false === self::_update($uid, "t_tel_login_", $mysql, $index, $data, "mobile='$mobile' and uid=$uid", __LINE__))
					return false;
			}
			else if(count($mobileInfo)==0)
			{
				$data = array('mobile'=> $mobile, 'uid'=> $uid, 'status'=> $_MobileStat['bound'], 'updatetime'=> $now);
				if (false === self::_insert($uid, "t_tel_login_", $mysql, $index, $data, __LINE__))
					return false;
			}
			
			if ($userOldInfo['mobile'] != '' && $userOldInfo['mobile'] != NULL) {

				if (false === self::_getDB2($userOldInfo['mobile'], "tel_login", $mysql, $index, __FILE__))
					return false;

				if (false === self::_remove($uid, "t_tel_login_", $mysql, $index, "mobile={$userOldInfo['mobile']} and uid=$uid", __LINE__))
					return false;
			}

			if (false === self::_getDB($uid, "users", $mysql, $index, __LINE__))
				return false;

			$data = array('mobile'=> $mobile, 'updatetime'=> $now);
			if (false === self::_update($uid, "t_users_", $mysql, $index, $data, "uid=$uid", __LINE__))
				return false;
		} else {
			if (false === self::_getDB2($mobile, "tel_login", $mysql, $index, __FILE__))
				return false;

			$data = array('mobile'=> $mobile, 'uid'=> $uid, 'status'=> $_MobileStat['bound'], 'updatetime'=> $now);

			if (false === self::_update($uid, "t_tel_login_", $mysql, $index, $data, "mobile='$mobile' and uid=$uid", __LINE__))
				return false;
		}
		
		$erpDb = ToolUtil::getMSDBObj('Customer');
		if (false === $erpDb) {

			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = ToolUtil::$errMsg;
			$sql = "rollback";
			$mysql->execSql($sql);
			return false;
		}

		$ret = $erpDb->update("Customer", array('CellPhoneStatus'=> $_MobileStat['bound'], 'CellPhone'=> $mobile, 'rowModifyDate'=> date('Y-m-d H:i:s')), "SysNo=$uid");
		if (false === $ret) {

			self::$errCode = $erpDb->errCode;
			self::$errMsg = $erpDb->errMsg;
			$sql = "rollback";
			$mysql->execSql($sql);
			return false;
		}
		$sql = "commit";
		$mysql->execSql($sql);
		Logger::info("Bind mobile, update tel_login. mobile: $mobile, uid: $uid, status: {$_MobileStat['bound']}, updatetime:$now");
		
		self::_purgeData4Int("IUsersTTC", $uid);
		self::_purgeData4StrV2("ITelLoginTTC", $mobile);
		self::_purgeData4StrV2("ITelLoginTTC", $userOldInfo['mobile']);

		//��Ѹ��󶨳ɹ���������ͳһ��
		UserWg::bindMobileOrEmailWg($uid, 2, $mobile);
		
		return true;
	}

	/**
	 * �������ֻ����󶨺��û��������ֻ���¼
	 */

	public static function realBindMobile($uid, $mobile, $code)
	{
		global $_MobileStat;
		$now = time();
		$checkRet = self::checkMobileAndUid($uid, $mobile);
		if (false === $checkRet) {
			return $checkRet;
		}


// 		$userInfo = self::_getTTCInfo("IUsersTTC", $uid);
		$userInfo = self::getUsersTTC($uid);
		if (false === $userInfo || count($userInfo) != 1)
			return false;


		$userInfo = $userInfo[0];
		if ("" == $userInfo['mobile'] || $mobile != $userInfo['mobile']) {
			self::$errCode = 25;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "uid($uid)'s mobile is null or not match";
			return false;
		}

// 		$item = self::_getTTCInfo("ITelLoginTTC", $mobile);
		$item = self::getTelLoginByMobile($mobile, $uid);
		if (false === $item)
			return false;

		$uidExist = false;
		$boundUid = 0;
		foreach ($item as $i) {
			if ($i['uid'] == $uid) {
				$uidExist = true;
			}
			if ($i['status'] == $_MobileStat['bound']) {
				$boundUid = $i['uid'];
			}
		}
		//�Ѿ��ǰ�״̬
		if ($uidExist === false) {
			self::$errCode = -30;
			self::$errMsg = "$mobile is not belong to $uid";
			return false;
		} else if ($boundUid == $uid) {
			return true;
		} else if ($boundUid > 0) {
			self::$errCode = -30;
			self::$errMsg = "$mobile is not bound to $boundUid already, can not bound to $uid";
			return false;
		}
		//��֤code�Ƿ���ȷ
		$ret = IVerify::checkMobileVerifyCode($uid, $code, $userInfo['mobile']);
		if (false === $ret) {
			self::$errCode = IVerify::$errCode;
			self::$errMsg = IVerify::$errMsg;
			return false;
		}

		if (false === self::_getDB2($userInfo['mobile'], "tel_login", $mysql, $index, __FILE__))
			return false;

		if (false === self::_startTrans($mysql, __LINE__))
			return false;

		$data = array('status'=> $_MobileStat['bound'], 'updatetime'=> $now);
		if (false === self::_update($uid, "t_tel_login_", $mysql, $index, $data, "mobile='{$userInfo['mobile']}' and uid=$uid", __LINE__))
			return false;

		$erpDb = ToolUtil::getMSDBObj('Customer');
		if (false === $erpDb) {
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = ToolUtil::$errMsg;
			$sql = "rollback";
			$mysql->execSql($sql);
			return false;
		}

		$ret = $erpDb->update("Customer", array('CellPhoneStatus'=> $_MobileStat['bound'], 'rowModifyDate'=> date('Y-m-d H:i:s')), "SysNo=$uid");
		if (false === $ret) {
			self::$errCode = $erpDb->errCode;
			self::$errMsg = $erpDb->errMsg;
			$sql = "rollback";
			$mysql->execSql($sql);
			return false;
		}

		$sql = "commit";
		$mysql->execSql($sql);

		self::_purgeData4StrV2("ITelLoginTTC", $userInfo['mobile']);
		
		//��Ѹ��󶨳ɹ���������ͳһ��
		UserWg::bindMobileOrEmailWg($uid, 2, $mobile);
		
		return true;
	}

	/**
	 * ���߲�ʹ��
	 */
	public static function realBindMobileWithoutCodeCheck($uid, $mobile)
	{
		$bindMobile = self::checkbindMobile($uid, $mobile);
		if ($bindMobile == false) {
			return false;
		}

		global $_MobileStat;
		$now = time();

// 		$userInfo = self::_getTTCInfo("IUsersTTC", $uid);
		$userInfo = self::getUsersTTC($uid);
		if (false === $userInfo || count($userInfo) != 1)
			return false;


		$userInfo = $userInfo[0];
		if ("" == $userInfo['mobile'] || $mobile != $userInfo['mobile']) {
			self::$errCode = 25;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "uid($uid)'s mobile is null or not match";
			return false;
		}

// 		$item = self::_getTTCInfo("ITelLoginTTC", $mobile);
		$item = self::getTelLoginByMobile($mobile, $uid);
		if (false === $item)
			return false;

		$uidExist = false;
		$boundUid = 0;
		foreach ($item as $i) {
			if ($i['uid'] == $uid) {
				$uidExist = true;
			}
			if ($i['status'] == $_MobileStat['bound']) {
				$boundUid = $i['uid'];
			}
		}
		//�Ѿ��ǰ�״̬
		if ($uidExist === false) {
			self::$errCode = -30;
			self::$errMsg = "$mobile is not belong to $uid";
			return false;
		} else if ($boundUid == $uid) {
			return true;
		} else if ($boundUid > 0) {
			self::$errCode = -30;
			self::$errMsg = "$mobile is not bound to $boundUid already, can not bound to $uid";
			return false;
		}

		if (false === self::_getDB2($userInfo['mobile'], "tel_login", $mysql, $index, __FILE__))
			return false;

		if (false === self::_startTrans($mysql, __LINE__))
			return false;

		$data = array('status' => $_MobileStat['bound'], 'updatetime' => $now);
		if (false === self::_update($uid, "t_tel_login_", $mysql, $index, $data, "mobile='{$userInfo['mobile']}' and uid=$uid", __LINE__))
			return false;

		$erpDb = ToolUtil::getMSDBObj('Customer');
		if (false === $erpDb) {
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = ToolUtil::$errMsg;
			$sql = "rollback";
			$mysql->execSql($sql);
			return false;
		}

		$ret = $erpDb->update("Customer", array('CellPhoneStatus' => $_MobileStat['bound'], 'rowModifyDate' => date('Y-m-d H:i:s')), "SysNo=$uid");
		if (false === $ret) {
			self::$errCode = $erpDb->errCode;
			self::$errMsg = $erpDb->errMsg;
			$sql = "rollback";
			$mysql->execSql($sql);
			return false;
		}

		$sql = "commit";
		$mysql->execSql($sql);

		self::_purgeData4StrV2("ITelLoginTTC", $userInfo['mobile']);
		
		//��Ѹ��󶨳ɹ���������ͳһ��
		UserWg::bindMobileOrEmailWg($uid, 2, $mobile);
		
		return true;
	}

	/**
	 * �����mobile
	 */
	public static function unBindMobile($uid, $mobile)
	{
		global $_MobileStat;
		$now = time();
		$checkRet = self::checkMobileAndUid($uid, $mobile);
		if (false === $checkRet) {
			return false;
		}

		if (false === self::_getDB2($mobile, "tel_login", $mysql, $index, __FILE__)) {
			return false;
		}

		if (false === self::_startTrans($mysql, __LINE__)) {
			return false;
		}

		$data = array('status'=> $_MobileStat['unbound'], 'updatetime'=> $now);
		if (false === self::_update($uid, "t_tel_login_", $mysql, $index, $data, "mobile='$mobile' and uid=$uid", __LINE__)) {
			return false;
		}

		if ($mysql->getAffectedRows() <= 0) {
			return false;
		}

		$erpDb = ToolUtil::getMSDBObj('Customer');
		if (false === $erpDb) {
			self::$errCode = ToolUtil::$errCode;
			self::$errMsg = ToolUtil::$errMsg;
			$sql = "rollback";
			$mysql->execSql($sql);
			return false;
		}

		$ret = $erpDb->update("Customer", array('CellPhoneStatus'=> $_MobileStat['unbound'], 'rowModifyDate'=> date('Y-m-d H:i:s')), "SysNo=$uid and CellPhone='$mobile'");

		if (false === $ret) {
			self::$errCode = $erpDb->errCode;
			self::$errMsg = $erpDb->errMsg;
			$sql = "rollback";
			$mysql->execSql($sql);
			return false;
		}

		$sql = "commit";
		$mysql->execSql($sql);
		self::_purgeData4StrV2("ITelLoginTTC", $mobile);

		//��������ͳһ�û��ӿ� ����û��ֻ���
		UserWg::unbindMobileOrEmailWg($uid, 2, $mobile);
		return true;
	}

	/*
	 *�޸�����
	 ����false��ʧ��
	 ����1�� ��������֤����
	 ����true���ɹ�
	 */

	public static function modifyPassword($uid, $newPass, $oldPass)
	{
		if ($uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . " uid($uid) is invalid";
			return false;
		}

		$newPassLen = strlen($newPass);
		if ($newPassLen < MIN_PASS_LEN || $newPassLen > MAX_PASS_LEN) {
			self::$errCode = 17;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . " new pass length is invalid";
			return false;
		}

		$oldPassLen = strlen($oldPass);
		if ($oldPassLen > MAX_PASS_LEN) {
			self::$errCode = 17;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . " old pass length is invalid";
			return false;
		}

		$item = self::_getTTCInfo("IUserPassTTC", $uid);
		if (false === $item)
			return false;

		if (($item[0]['password']) != md5($oldPass)) {
			self::$errMsg = "������ľ����벻��ȷ";
			self::$errCode = 35;
			return false;
		}
		//������У��ͨ��

		if (false === self::modifyPswWithoutOldPsw($uid, $newPass, $oldPass, true))
			return false;

		return true;

	}

	/*�һأ��û��һ����룬���û�
	 *
	 o $type ; 1:�һ�����
	 2���һص�¼��
	 ���أ�
	 false��ʧ��
	 1:�һص�emailû�ж�Ӧ���κ��û�
	 $url���ɹ�
	 */

	public static function findBack($email, $type = 1) //Ĭ��Ϊ�һ�����
	{
		global $_EmailStat;
		if (!isset($email) || "" == $email) {
			self::$errCode = 10;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'email is null';
			return false;
		}

		if (!ToolUtil::checkEmail($email)) {
			self::$errCode = 11;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "email($email) is invalid";
			return false;
		}

		if ($type != 1 && $type != 2) {
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "type($type) is invalid";
			return false;
		}

// 		$item = self::_getTTCInfo("IEmailLoginTTC", $email, array('status' => $_EmailStat['bound']));
		$item = self::getEmailLoginByEmail($email, 0, false, true);
		if (false === $item)
			return false;

		if (0 == count($item)) {
			self::$errMsg = "��Emailû���û�ʹ��";
			self::$errCode = 29;
			return false;
		}

		$url = "http://base.51buy.com/index.php?mod=findpassword&act=modify&type=$type&uid=" . $item[0]['uid'];
		$ck = self::getFindBackCK($type, $item[0]['uid']);
		$url .= "&ck=$ck";
		return $url;
	}

	public static function getFindBackCK($type, $uid)
	{
		return md5(strtoupper(md5($type . $uid) . FIND_BACK_OP_KEY));
	}

	public static function checkFindBackCK($type, $uid, $ck)
	{
		$oCK = self::getFindBackCK($type, $uid);
		return $ck == $oCK;
	}

	/*
	 *�޸����룬������֤�����룬�����һ���������������
	 ����false��ʧ��
	 ����true���ɹ�
	 */

	public static function modifyPswWithoutOldPsw($uid, $newPass, $oldPass="", $need=false)
	{
		if ($uid <= 0) {
			self::$errCode = 21;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . " uid($uid) is invalid";
			return false;
		}

		$newPassLen = strlen($newPass);
		if ($newPassLen < MIN_PASS_LEN || $newPassLen > MAX_PASS_LEN) {
			self::$errCode = 17;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . " new pass length is invalid";
			return false;
		}

		$now = time();

		if (false === self::_getDB($uid, "user_pass", $mysql, $index, __LINE__))
			return false;
		/*
		  if (false === $mysql->execSql("begin"))
		  {
			  self::$errCode = $mysql->errCode;
			  self::$Msg = basename(__FILE__,"php"). " | ". __LINE__ . " start transaction failed! " .$mysql->Msg;
			  return false;
		  }
  */
		$data = array('pass'=> '', 'password'=> md5($newPass), 'updatetime'=> $now);
		if (false === self::_update($uid, "t_user_pass_", $mysql, $index, $data, "uid=$uid", __LINE__))
			return false;
		/*
		  $erpDb = ToolUtil::getMSDBObj('Customer');
		  if (false === $erpDb) {
			  self::$errCode = ToolUtil::$errCode;
			  self::$errMsg = ToolUtil::$errMsg;
			  $sql = "rollback";
			  $mysql->execSql($sql);
			  return false;
		  }

		  $ret = $erpDb->update("Customer", array('Pwd'=>$newPass, 'rowModifyDate'=>date("Y-m-d H:i:s")), "SysNo=$uid");
		  if (false === $ret) {
			  self::$errCode = $erpDb->errCode;
			  self::$errMsg = $erpDb->errMsg;
			  $sql = "rollback";
			  $mysql->execSql($sql);
			  return false;
		  }
		  $sql = "commit";
		  $mysql->execSql($sql);
  */
		self::_purgeData4Int("IUserPassTTC", $uid);

		global $_SERVER;
		//��¼�����޸���ˮ
		$passDB = Config::getDB('icson_core');
		if (!empty($passDB)) {
			$passDB->insert('t_user_pass_flow', array('uid'=> $uid, 'password'=> $newPass, 'ip'=> $_SERVER['REMOTE_ADDR'], 'updatetime'=> $now));
		}
		if($need)
		{
			//���ܳɹ������������޸�����
			UserWg::modifyPasswordWg($uid, $newPass, $oldPass);
		}
		else
		{
			//���ܳɹ������������޸�����
			UserWg::resetPasswordWg($uid, $newPass);
		}
		return true;
	}

	/**
	 * ��֤�û���ݣ����ڵ�¼����ʾ�����޸�
	 * @param  [type] $uid [description]
	 * @return [type]      [description]
	 */
	private static function _checkUserIdentity($uid)
	{
		//return true;
		$userIP = ToolUtil::getClientIP();
		$vk = isset($_COOKIE["visitkey"])?$_COOKIE["visitkey"]:'';
		$request = array(
		    "user_id" => $uid,
		    "ip" => $userIP,
		    "vk" => $vk
		);
		$req = json_encode($request);
		$net = Config::getIP('VERIFY_IDENTITY_CHANGEPWD_HINT');
		if(!$net)
		{
			Logger::err("_checkUserIdentity Get Ip Error".print_r($net,true));
			return false;
		}

		if($uid%2 == 0)
		{
		    $ip = $net[0]["IP"];
		    $port = $net[0]["PORT"];
		}
		else
		{
		    $ip = $net[1]["IP"];
		    $port = $net[1]["PORT"];
		}
		$response = NetUtil::udpCmd($ip, $port, $req);
		
		if($response === false)
		{
			Logger::err("_checkUserIdentity error");
			return false;
		}
		else
		{
			$response = json_decode($response, true);
			
			if($response['user_id'] == $uid && $response['hint'] == 1)
			{
				return true;
			}
		}

		return false;
	}	
	//��¼
	//$multiLogin: �Ƿ�����ͬʱ��ͻ��˵�¼ 0�������� ����������
	//$type : 0����Ѹ�ʺŵ�¼ 1: email��¼ 2: �ֻ���¼, 3:QQ�ʺŵ�¼ 4��֧������¼ 5: 51fanli��¼
	public static function login($account, $pass, $cip, $multiLogin = 0, $type = 0, $needPassword = true, $uin = 0, $ptskey = '')
	{
		global $_LoginType,$_AccountType;
		$mathch = stripos($account, QQ_ACCOUNT_PRE);
		if ($type == $_LoginType['qq'] && $mathch !== 0) {
			self::$errCode = 99;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[QQ login account is not invalid" . $type . " , user " . $account;
			IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
			return false;
		} else if ($type != $_LoginType['qq'] && $mathch === 0) {
			self::$errCode = 100;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[not QQ login account is not invalid" . $type . " , user " . $account;
			IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
			return false;
		}

		$mathch = stripos($account, ALIPAY_ACCOUNT_PRE);
		if ($type == $_LoginType['alipay'] && $mathch !== 0) {
			self::$errCode = 99;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[QQ login account is not invalid" . $type . " , user " . $account;
			IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
			return false;
		} else if ($type != $_LoginType['alipay'] && $mathch === 0) {
			self::$errCode = 100;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[not QQ login account is not invalid" . $type . " , user " . $account;
			IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
			return false;
		}

		if ($type == $_LoginType['51fanli'] && !preg_match('/^\d+@51fanli$/i', $account)) {
			self::$errCode = 99;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[51fanli login account is not invalid" . $type . " , user " . $account;
			IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
			return false;
		}

		global $_EmailStat, $_MobileStat, $_IcsonAccStat;

		$item = array();
		if ($type == $_LoginType['email']) {
// 			$item = self::_getTTCInfo("IEmailLoginTTC", $account);
			$item = self::getEmailLoginByEmail($account);
		} else if ($type == $_LoginType['mobile']) {
// 			$item = self::_getTTCInfo("ITelLoginTTC", $account);
			$item = self::getTelLoginByMobile($account);
		} else {
// 			$item = self::_getTTCInfo("IIcsonLoginTTC", $account);
			$item = self::getUserInfoByAccount($account);
		}

		if (false === $item) {
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[faild to get account info" . $type . " , user " . $account;
			IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
			return false;
		}

		if (count($item) == 0) {
			self::$errCode = 67;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[query loginTTC" . $type . " , user " . $account . " not exist!]";
			IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
			return false;
		}

		if (($type == $_LoginType['email'] && $item[0]['status'] != $_EmailStat['bound'])
			|| ($type == $_LoginType['mobile'] && $item[0]['status'] != $_MobileStat['bound'])
		) {
			self::$errCode = 99;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[login with not bind mail or mobile " . $type . "]";
			IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
			return false;
		}

		$uid = $item[0]['uid'];
		$wg_skey = '';
		$skey = '';
		$accountType = $_AccountType['invalid'];
		$passwd = '';
		if($type == $_LoginType['icson']){//��ʾ��Ѹ��¼
			$accountType = $_AccountType['custom'];
			$passwd = $pass;
		}else if($type == $_LoginType['qq']){//QQ��¼
			$accountType = $_AccountType['qq'];
		}else{//Ĭ��Ϊ���ϵ�¼����QQ��
			$accountType = $_AccountType['custom'];
			$passwd = $account;
		}
		if(!ToolUtil::is_mobile()){
			$IcsonUserLoginResult = UserWg::IcsonUserLogin($uid, $accountType, $account, $passwd, $uin, $ptskey);
			if($IcsonUserLoginResult === false){
				self::$errCode = 99;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[UserWg::IcsonUserLogin fail]";
				IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
				return false;
			}
			$GetSkeyResult = UserWg::GetSkey($uid,$ptskey);
			if($GetSkeyResult === false){
				self::$errCode = 100;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[UserWg::GetSkey fail]";
				IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
				return false;
			}
			if(empty($GetSkeyResult->skey)){
				self::$errCode = 101;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[UserWg::GetSkey fail]";
				IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
				return false;
			}else{
				$wg_skey = $GetSkeyResult->skey;
				$skey = $wg_skey;
			}
		}else{
			//qq�ʺŵ�¼����Ҫ��֤����
			if ($type != $_LoginType['qq']
					&& $type != $_LoginType['alipay']
					&& $type != $_LoginType['51fanli']
					&& $type != $_LoginType['shcar']
					&& true === $needPassword
			) {
				$IcsonUserLoginResult = UserWg::IcsonUserLogin($uid, $accountType, $account, $passwd, $uin, $ptskey);
				/*$passitem = self::_getTTCInfo("IUserPassTTC", $uid);
				if (false === $passitem) {
					self::$errCode = 99;
					self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[get userpass ttc failed" . $type . " , user " . $account;
					IReportLoginData::report($type, $uid, $account, 2, self::$errMsg);
					return false;
				}
			
				if (count($passitem) == 0) {
					self::$errCode = 66;
					self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[query passTTC, pass not exist!]";
					IReportLoginData::report($type, $uid, $account, 2, self::$errMsg);
					return false;
				}
			
				if (md5($pass) != $passitem[0]['password']) {
					self::$errCode = 66;
					self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[password not correct!]";
					IReportLoginData::report($type, $uid, $account, 2, self::$errMsg);
					return false;
				}*/
			}
			
// 			$user = self::_getTTCInfo("IUsersTTC", $uid, array(), array('status'));
			$user = self::getUsersTTC($uid);
			if (false === $user || count($user) != 1) {
				self::$errCode = 67;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[no such user]";
				IReportLoginData::report($type, $uid, $account, 2, self::$errMsg);
				return false;
			}
			if ($user[0]['status'] != 0) {
				self::$errCode = 68;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[user status is invalid]";
				IReportLoginData::report($type, $uid, $account, 2, self::$errMsg);
				return false;
			}
			
			//��ȡskey
			if ($uid == 5022043)
				$multiLogin = true; // ������������ĺ��룬����¼
			
			$cmd = "cmd=1000&uid=" . $uid . "&ip=" . $cip . "&newKey=" . $multiLogin . "\r\n";
			$rspStr = self::getSession($uid, $cmd);
			if (false === $rspStr) {
				self::$errCode = 99;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[get session failed" . $type . " , user " . $account;
				IReportLoginData::report($type, $uid, $account, 2, self::$errMsg);
				return false;
			}
			
			$rspArr = json_decode($rspStr, true);
			if ($rspArr['errCode'] != 0 || !isset($rspArr['skey'])) {
				self::$errCode = 99;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[query sessiond faild:" . $rspArr['errMsg'] . " " . $rspArr['errCode'] . "]";
				IReportLoginData::report($type, $uid, $account, 2, self::$errMsg);
				return false;
			}
			$skey = $rspArr['skey'];
		}

		//��֤�û��Ƿ���Ҫ����
		if(self::_checkUserIdentity(intval($uid)))
		{
			$hint = 1;
		}
		else
		{
			$hint = 0;
		}

		//��¼�û��ĵ�¼��Ϊ
		IAsyTask::userLogin($uid, ToolUtil::getClientIP());

		IReportLoginData::report($type, $uid, $account);

		return array('uid'=> $uid, 'skey'=> $skey, 'wg_skey'=>$wg_skey,'hint' => $hint);
	}
	
	//�Ƿ����ڻҶ�
	public static function ifInGray($uid){
		return true;
		$grayUidArr = array();
		$environment = Config::getEnvName();
		switch ($environment){
			case 'dev.':
				global $devUidArr;
				//$grayUidArr = array(30566183,30566010,30566441,30566013,30558209,30566443,30566259,30566444,30566452);
				$grayUidArr = $devUidArr;
				break;
			case 'test55.':
				global $betaUidArr;
				//$grayUidArr = array(106728029,106728943,106728749,106729018,106728999,106728968,106729008,106729022,106729023);
				$grayUidArr = $betaUidArr;
				break;
			case 'beta.':
				global $gammaUidArr;
				//$grayUidArr = array(206148795,4393386,193703306,176962539,192023164,207174920,207915010,207950603,207950855);
				$grayUidArr = $gammaUidArr;
				break;
			default:
				global $idcUidArr;
				//$grayUidArr = array(198176676,5341499,4306069,91941045,175846745,195883265,17418995,196902649,690054,193703306,4393386,207915010,59680989,177836835,207830009);
				$grayUidArr = $idcUidArr;
				break;
		}
		$modNum = 0;
		$equNum = 0;
		$modBool = false;
		@$icsonLoginMod=explode (':', configcenter4_get_serv("IcsonLoginMod", 0, 0) );
		@$modNum = $icsonLoginMod[1];
		
		if($modNum != 1){
			@$icsonLoginEqu=explode (':', configcenter4_get_serv("IcsonLoginEqu", 0, 0) );
			@$equNum = $icsonLoginEqu[1];
			$modBool = ($uid%$modNum == $equNum);
		}
		$inGray = in_array($uid, $grayUidArr) || $modBool;
		
		return $inGray;
	}


	//��¼
	//$multiLogin: �Ƿ�����ͬʱ��ͻ��˵�¼ 0�������� ����������
	//$type : 0����Ѹ�ʺŵ�¼ 1: email��¼ 2: �ֻ���¼, 3:QQ�ʺŵ�¼ 4��֧������¼ 5: 51fanli��¼
	public static function wlogin($account, $pass, $cip, $multiLogin = 0, $type = 0, $needPassword = true)
	{
		global $_LoginType,$_AccountType;
		$mathch = stripos($account, QQ_ACCOUNT_PRE);
		if ($type == $_LoginType['qq'] && $mathch !== 0) {
			self::$errCode = 99;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[QQ login account is not invalid" . $type . " , user " . $account;
			IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
			return false;
		} else if ($type != $_LoginType['qq'] && $mathch === 0) {
			self::$errCode = 100;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[not QQ login account is not invalid" . $type . " , user " . $account;
			IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
			return false;
		}

		$mathch = stripos($account, ALIPAY_ACCOUNT_PRE);
		if ($type == $_LoginType['alipay'] && $mathch !== 0) {
			self::$errCode = 99;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[QQ login account is not invalid" . $type . " , user " . $account;
			IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
			return false;
		} else if ($type != $_LoginType['alipay'] && $mathch === 0) {
			self::$errCode = 100;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[not QQ login account is not invalid" . $type . " , user " . $account;
			IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
			return false;
		}

		if ($type == $_LoginType['51fanli'] && !preg_match('/^\d+@51fanli$/i', $account)) {
			self::$errCode = 99;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[51fanli login account is not invalid" . $type . " , user " . $account;
			IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
			return false;
		}

		global $_EmailStat, $_MobileStat, $_IcsonAccStat;

		$item = array();
		if ($type == $_LoginType['email']) {
// 			$item = self::_getTTCInfo("IEmailLoginTTC", $account);
			$item = self::getEmailLoginByEmail($account);
		} else if ($type == $_LoginType['mobile']) {
// 			$item = self::_getTTCInfo("ITelLoginTTC", $account);
			$item = self::getTelLoginByMobile($account);
		} else {
// 			$item = self::_getTTCInfo("IIcsonLoginTTC", $account);
			$item = self::getUserInfoByAccount($account);
		}

		if (false === $item){
			self::$errCode = 101;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[faild to get account info" . $type . " , user " . $account;
			IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
			return false;
		}

		if (count($item) == 0) {
			self::$errCode = 67;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[query loginTTC" . $type . " , user " . $account . " not exist!]";
			IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
			return false;
		}

		if (($type == $_LoginType['email'] && $item[0]['status'] != $_EmailStat['bound'])
			|| ($type == $_LoginType['mobile'] && $item[0]['status'] != $_MobileStat['bound'])
		) {
			self::$errCode = 67;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[login with not bind mail or mobile " . $type . "]";
			IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
			return false;
		}

		$uid = $item[0]['uid'];

		//qq�ʺŵ�¼����Ҫ��֤����
		if ($type != $_LoginType['qq']
			&& $type != $_LoginType['alipay']
			&& $type != $_LoginType['51fanli']
			&& $type != $_LoginType['shcar']
			&& true === $needPassword
		) {

			if($type == $_LoginType['icson']){//��ʾ��Ѹ��¼
				$accountType = $_AccountType['custom'];
				$passwd = $pass;
			}else if($type == $_LoginType['qq']){//QQ��¼
				$accountType = $_AccountType['qq'];
			}else{//Ĭ��Ϊ���ϵ�¼����QQ��
				$accountType = $_AccountType['custom'];
				$passwd = $account;
			}
			
			$IcsonUserLoginResult = UserWg::IcsonUserLogin($uid, $accountType, $account, $passwd);
			if($IcsonUserLoginResult === false){
				self::$errCode = 99;
				self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[UserWg::IcsonUserLogin fail]";
				IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
				return false;
			}
			/*$passitem = self::_getTTCInfo("IUserPassTTC", $uid);
			if (false === $passitem) {
				self::$errCode = 99;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[get userpass ttc failed" . $type . " , user " . $account;
				IReportLoginData::report($type, $uid, $account, 2, self::$errMsg);
			}

			if (count($passitem) == 0) {
				self::$errCode = 66;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[query passTTC, pass not exist!]";
				IReportLoginData::report($type, $uid, $account, 2, self::$errMsg);
				return false;
			}

			if (md5($pass) != $passitem[0]['password']) {
				self::$errCode = 66;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[password not correct!]";
				IReportLoginData::report($type, $uid, $account, 2, self::$errMsg);
				return false;
			}*/
		}

// 		$user = self::_getTTCInfo("IUsersTTC", $uid, array(), array('status'));
		$user = self::getUsersTTC($uid);
		if (false === $user) {
			self::$errCode = 67;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[no such user]";
			IReportLoginData::report($type, $uid, $account, 2, self::$errMsg);
			return false;
		} else if (count($user) != 1) {
			self::$errCode = 67;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[no such user]";
			IReportLoginData::report($type, $uid, $account, 2, self::$errMsg);
			return false;
		}
		if ($user[0]['status'] != 0) {
			self::$errCode = 68;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[user status is invalid]";
			IReportLoginData::report($type, $uid, $account, 2, self::$errMsg);
			return false;
		}

		//��ȡskey
		if ($uid == 5022043)
			$multiLogin = true; // ������������ĺ��룬����¼

		$cmd = "cmd=1000&uid=" . $uid . "&ip=" . $cip . "&newKey=" . $multiLogin . "\r\n";
		$rspStr = self::getSession($uid, $cmd);
		if (false === $rspStr) {
			self::$errCode = 68;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[failed to get session]";
			IReportLoginData::report($type, $uid, $account, 2, self::$errMsg);
			return false;
		}

		$rspArr = json_decode($rspStr, true);
		if ($rspArr['errCode'] != 0 || !isset($rspArr['skey'])) {
			self::$errCode = 68;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[query sessiond faild:" . $rspArr['errMsg'] . " " . $rspArr['errCode'] . "]";
			IReportLoginData::report($type, 0, $account, 2, self::$errMsg);
			return false;
		}

		//��¼�û��ĵ�¼��Ϊ
		IAsyTask::userLogin($uid, ToolUtil::getClientIP());

		IReportLoginData::report($type, $uid, $account);

		return array('uid'=> $uid, 'skey'=> $rspArr['skey']);
	}


	//�˳�
	public static function logout($uid)
	{
		if (!is_numeric($uid) || $uid < 0) {
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[uid is invalid!]";
			return false;
		}

		//ɾ��skey
		$cmd = "cmd=2000&uid=" . $uid . "\r\n";
		$rspStr = self::getSession($uid, $cmd);
		if (false === $rspStr) {
			return false;
		}

		$rspArr = json_decode($rspStr, true);

		return $rspArr['errCode'];

	}

	// others : for site

	//��ת������ҳ
	public static function redirectOldSite()
	{
		setcookie(self::$siteKey, 1, time() + self::$siteKeyExpires, "/", ".51buy.com");
		ToolUtil::redirect("http://www.51buy.com/");
	}

	/**
	 * ����IP������ת
	 * @param string $ip ���ʽIP
	 * @return ���߻��ǳ���,��վID
	 */
	public static function getSiteIdByIp($ip, $cps_info = '')
	{
		global $_CITY_WEBSIT_CFG, $_WEBSITE_CFG;
		$ipInfo = NetUtil::getCityByIp($ip);
		if ($ipInfo === false || empty($ipInfo)) {
			// Ĭ�ϻ����Ϻ�վ
			return "1001,1";
		}

		// ====BEGIN ���ݵĸ��Ի����� BEGIN====
		// BEGIN ��һ�� �½�������
		/*$firstCity = array(65, 54, 51, 50, 42);
			if (isset($ipInfo['prov']) && strlen($ipInfo['prov']) === 2) {
				if (in_array($ipInfo['prov'], $firstCity)) {
					return "1001,1"; // ���Ϻ�վ
				}
			}
			if (isset($ipInfo['city']) && strlen($ipInfo['city']) === 4) {
				if (in_array($ipInfo['city'], $firstCity)) {
					return "1001,1"; // ���Ϻ�վ
				}
			}*/
		// END ��һ�� �½�������

		// TODO �ڶ�����Ҫ����Ĳ���
		// BEGIN �ڶ��� ���㻦����ɽ������֮��
		/*$revert_city = array(
		   '31'
		   );
		   if (isset($ipInfo['prov']) && strlen($ipInfo['prov']) === 2) {
				// ��Щ���е�����ȥ
			   if (in_array($ipInfo['prov'], $revert_city)) {
				   return "1,1";
			   }
		   }

		   if (isset($ipInfo['city']) && strlen($ipInfo['city']) === 4) {
				// ��Щ���е�����ȥ
			   if (in_array($ipInfo['city'], $revert_city)) {
				   return "1,1";
			   }
		   }*/
		// END �ڶ��� ���㻦����ɽ������֮��
		// ====END ���ݵĸ��Ի����� END====

		if (isset($ipInfo['prov']) && strlen($ipInfo['prov']) === 2 && isset($_CITY_WEBSIT_CFG[$ipInfo['prov']])) {
			if (!empty($_WEBSITE_CFG[$_CITY_WEBSIT_CFG[$ipInfo['prov']]['site_id']]) && $_WEBSITE_CFG[$_CITY_WEBSIT_CFG[$ipInfo['prov']]['site_id']]['valid'] == 1) {
				// TODO �ڶ�����Ҫ����Ĳ���
				return "1001," . $_CITY_WEBSIT_CFG[$ipInfo['prov']]['site_id'];
				//return $_CITY_WEBSIT_CFG[$ipInfo['prov']] .',' . $_CITY_WEBSIT_CFG[$ipInfo['prov']];
			}
		}

		if (isset($ipInfo['city']) && strlen($ipInfo['city']) === 4 && isset($_CITY_WEBSIT_CFG[$ipInfo['city']])) {
			if (!empty($_WEBSITE_CFG[$_CITY_WEBSIT_CFG[$ipInfo['city']]['site_id']]) && $_WEBSITE_CFG[$_CITY_WEBSIT_CFG[$ipInfo['city']]['site_id']]['valid'] == 1) {
				// TODO �ڶ�����Ҫ����Ĳ���
				return "1001," . $_CITY_WEBSIT_CFG[$ipInfo['city']]['site_id'];
				//return $_CITY_WEBSIT_CFG[$ipInfo['city']] .',' . $_CITY_WEBSIT_CFG[$ipInfo['city']];
			}
		}

		return "1001,1";
	}

	/**
	 * ��ȡ����վ��Ϣ
	 */
	public static function getSiteInfo($_siteId = NULL)
	{
		global $_WEBSITE_CFG;

		$siteId = self::getSiteId($_siteId);

		return empty($_WEBSITE_CFG[$siteId]) || $_WEBSITE_CFG[$siteId]['valid'] != 1 ? false : $_WEBSITE_CFG[$siteId];
	}

	//�人վ - ���� getSiteId ����,ȥ���人վ
	public static function getSiteIdWrapper($_siteId = NULL)
	{
		return self::getSiteId($_siteId);
	}

	//����cookie�еı�ǻ�IP��λ��վID, ��λ��վʧ�ܻ���δ��ͨ�򷵻�false
	//�������wap������session�еı�ǻ�IP��λ��վID  modified by qingliang
	public static function getSiteId($_siteId = NULL)
	{
		global $_WEBSITE_CFG;

		if (defined('IN_MOBILE')) { //��������wap
			if (!empty($_siteId) && isset($_WEBSITE_CFG[$_siteId])) {
				self::$siteId = $_siteId;

				if (!isset($_SESSION['siteId']) || $_SESSION['siteId'] != self::$siteId) {
					$_SESSION['siteId'] = self::$siteId;
				}

				return self::$siteId;
			}

			//����session����
			if (!empty($_SESSION['siteId']) && isset($_WEBSITE_CFG[$_SESSION['siteId']])) { //�ͻ���������վ���
				self::$siteId = $_SESSION['siteId'];
				return self::$siteId;
			}

			// IP��λ��վ
			$ip = ToolUtil::getClientIP();
			$siteId = self::getSiteIdByIp($ip);
			if (empty($siteId)) {
				$siteId = 1;
			} else {
				$siteId = explode(',', $siteId);
				$siteId = isset($siteId[1]) ? $siteId[1] : $siteId[0];
			}

			if (!isset($_WEBSITE_CFG[$siteId]) || $_WEBSITE_CFG[$siteId]['valid'] != 1) {
				$siteId = 1;
			}

			self::$siteId = $siteId;
			if (!isset($_SESSION['siteId']) || $_SESSION['siteId'] != self::$siteId) {
				$_SESSION['siteId'] = self::$siteId;
			}
			return $siteId;

		}

		//�ͻ���ǿ��ѡ����վ
		if (!empty($_siteId) && isset($_WEBSITE_CFG[$_siteId])) {
			self::$siteId = $_siteId;

			//����cookie
			setcookie(self::$siteKey, self::$siteId, time() + self::$siteKeyExpires, '/', '.51buy.com');
			global $_ProvinceToWhid, $PROVINCEID_MAP_DEFAULT_PRID;


			$provId = 2621;
			//����ʡ��cookie
			if (isset($_COOKIE[self::LOCATION_COOKIE])) {
				$pkk = explode("_", $_COOKIE[self::LOCATION_COOKIE]);
				//��ǰʡ����ǿ�Ƶ�siteId,��ͬ�����ã���ͬҪ����Ĭ��
				if (self::$siteId != $_ProvinceToWhid[$pkk[1]]) {
					foreach ($_ProvinceToWhid as $key => $value) {
						if ($_siteId == $value) {
							$provId = $key;
							break;
						}
					}

					self::$provId = $provId;

					$locId = $PROVINCEID_MAP_DEFAULT_PRID[$provId];
					setcookie(self::LOCATION_COOKIE, $locId . '_' . self::$provId, time() + self::$siteKeyExpires, '/', '.51buy.com');
				}
			} else { //������ʡ��cookie
				//����ip�õ�ʡ��id
				$ip = ToolUtil::getClientIP();
				$ipInfo = NetUtil::getCityByIp($ip);
				if (false === $ipInfo) {
					// ����IP��ȡʡ�б���ʧ�ܣ�����Ĭ��ֵ
					$prov = 31;// �Ϻ�
					self::$cityId = 404; // �Ϻ��У���ͨipagent����
				}else{
					$prov = $ipInfo['prov'];
					self::$cityId = $ipInfo['city2'];
				}
				if (!empty($prov)) {
					global $_Province2city;
					foreach ($_Province2city as $key => $kc) {
						if ($prov == $kc) {
							$provId = $key;
							break;
						}
					}

					self::$provId = $provId;
				}

				//�ж�ip�ĵ���ʡ��ip�뵱ǰվ��һ��ʱ����ʡ��cookie����һ��������Ĭ��ʡ��
				if (self::$siteId != $_ProvinceToWhid[$provId]) {
					foreach ($_ProvinceToWhid as $key => $value) {
						if ($_siteId == $value) {
							$provId = $key;
							break;
						}
					}

					self::$provId = $provId;
				}


				$locId = IPCodeConfig::getErpDftDistIdByIMCityId(self::$cityId);
				if (false === $locId) {
					$locId = $PROVINCEID_MAP_DEFAULT_PRID[$provId];
				}

				setcookie(self::LOCATION_COOKIE, $locId . '_' . self::$provId, time() + self::$siteKeyExpires, '/', '.51buy.com');
			}

			return self::$siteId;
		}

		//��������������վID
		if (!empty(self::$siteId)) {
			return self::$siteId;
		}

		//����cookie�õ�siteid����֤prid������prid
		if (!empty($_COOKIE[self::$siteKey]) && isset($_WEBSITE_CFG[$_COOKIE[self::$siteKey]])) { //�ͻ���������վ���

			self::$siteId = $_COOKIE[self::$siteKey];
			if (isset($_COOKIE[self::LOCATION_COOKIE])) {
				self::checkSiteIdAndPrId();
			} else { //û��cookie�����
				global $_ProvinceToWhid, $PROVINCEID_MAP_DEFAULT_PRID;

				$provId = 2621;
				$ip = ToolUtil::getClientIP();
				$ipInfo = NetUtil::getCityByIp($ip);
				$prov = $ipInfo['prov'];
				if (false === $ipInfo) {
					// ����IP��ȡʡ�б���ʧ�ܣ�����Ĭ��ֵ
					$prov = 31;// �Ϻ�
					self::$cityId = 404; // �Ϻ��У���ͨipagent����
				}else{
					$prov = $ipInfo['prov'];
					self::$cityId = $ipInfo['city2'];
				}
				if (!empty($prov)) {
					global $_Province2city;
					foreach ($_Province2city as $key => $kc) {
						if ($prov == $kc) {
							$provId = $key;
							break;
						}
					}
					self::$provId = $provId;
				}

				//ip������վ�㲻һ��ʱ���õ�ǰվ��Ĭ��ip
				if (self::$siteId != $_ProvinceToWhid[$provId]) {
					foreach ($_ProvinceToWhid as $key => $value) {
						if (self::$siteId == $value) {
							$provId = $key;
							break;
						}
					}

					self::$provId = $provId;
				}

				$locId = IPCodeConfig::getErpDftDistIdByIMCityId(self::$cityId);
				if (false === $locId) {
					$locId = $PROVINCEID_MAP_DEFAULT_PRID[$provId];
				}
				setcookie(self::LOCATION_COOKIE, $locId . '_' . self::$provId, time() + self::$siteKeyExpires, '/', '.51buy.com');
			}

			return self::$siteId;
		}

		// IP��λwhid��prid
		$ip = ToolUtil::getClientIP();
		$siteId = self::getSiteIdByIp($ip);
		if (empty($siteId)) {
			$siteId = 1;
		} else {
			$siteId = explode(',', $siteId);
			$siteId = isset($siteId[1]) ? $siteId[1] : $siteId[0];
		}

		if (!isset($_WEBSITE_CFG[$siteId]) || $_WEBSITE_CFG[$siteId]['valid'] != 1) {
			$siteId = 1;
		}

		self::$siteId = $siteId;

		setcookie(self::$siteKey, self::$siteId, time() + self::$siteKeyExpires, '/', '.51buy.com'); // cookie��Ч�ڣ����������

		//����ip����ȡվ���ʱ��ͬʱ����ip��ȡʡ��
		global $_ProvinceToWhid, $PROVINCEID_MAP_DEFAULT_PRID;
		$provId = 2621;
		$ip = ToolUtil::getClientIP();
		$ipInfo = NetUtil::getCityByIp($ip);
		$prov = $ipInfo['prov'];
		if (false === $ipInfo) {
			// ����IP��ȡʡ�б���ʧ�ܣ�����Ĭ��ֵ
			$prov = 31;// �Ϻ�
			self::$cityId = 404; // �Ϻ��У���ͨipagent����
		}else{
			$prov = $ipInfo['prov'];
			self::$cityId = $ipInfo['city2'];
		}
		if (!empty($prov)) {
			global $_Province2city;
			foreach ($_Province2city as $key => $kc) {
				if ($prov == $kc) {
					$provId = $key;
					break;
				}
			}
		}

		self::$provId = $provId;
		$locId = IPCodeConfig::getErpDftDistIdByIMCityId(self::$cityId);
		if (false === $locId) {
			$locId = $PROVINCEID_MAP_DEFAULT_PRID[$provId];
		}
		setcookie(self::LOCATION_COOKIE, $locId . '_' . self::$provId, time() + self::$siteKeyExpires, '/', '.51buy.com');

		return $siteId;
	}

	//��ȡʡ��
	public static function getProvId($prid = '')
	{
		global $_CITY_WEBSIT_CFG, $PROVINCEID_MAP_DEFAULT_PRID, $_ProvinceToWhid;

		//ǿ������ʡ��
		if (!empty($prid) && isset($PROVINCEID_MAP_DEFAULT_PRID[$prid])) {
			self::$provId = $prid;
			self::$siteId = $_ProvinceToWhid[$prid];

			setcookie(self::$siteKey, self::$siteId, time() + self::$siteKeyExpires, '/', '.51buy.com');
			$locId = $PROVINCEID_MAP_DEFAULT_PRID[self::$provId];
			setcookie(self::LOCATION_COOKIE, $locId . '_' . self::$provId, time() + self::$siteKeyExpires, '/', '.51buy.com');

			return self::$provId;
		}

		//���ʡ��id
		self::$siteId = self::getSiteId();

		return self::$provId;
	}

	//��ȡCOOKIE�е���������ID
	public static function getLocId()
	{
		if (isset($_COOKIE[self::LOCATION_COOKIE])) {
			$prida = explode('_', $_COOKIE[self::LOCATION_COOKIE]);
			return $prida[0];
		}
		return self::getProvId();
	}

	//��ȡվ��ip����ֱ��ip�жϣ�����cookie�й�ϵ��
	public static function getSiteIdNoCookie()
	{

		global $_WEBSITE_CFG;

		// IP��λ��վ
		$ip = ToolUtil::getClientIP();
		$siteId = self::getSiteIdByIp($ip);
		if (empty($siteId)) {
			$siteId = 1;
		} else {
			$siteId = explode(',', $siteId);
			$siteId = isset($siteId[1]) ? $siteId[1] : $siteId[0];
		}

		if (!isset($_WEBSITE_CFG[$siteId]) || $_WEBSITE_CFG[$siteId]['valid'] != 1) {
			$siteId = 1;
		}
		self::getSiteId($siteId);
		//self::$siteId = $siteId;
		//setcookie(self::$siteKey, self::$siteId, time() + self::$siteKeyExpires, '/', '.51buy.com'); // cookie��Ч�ڣ����������
		return $siteId;
	}

	//�Ƿ���ͨ��QQ��¼���˺�
	public static function validateUserFromQQ($uid)
	{
		$userInfo = self::getUserInfo($uid);

		if ($userInfo === false) {
			return false;
		}

		return array('validate' => strpos($userInfo['icsonid'], QQ_ACCOUNT_PRE) === 0 ? true : false);

	}

	//�Ƿ���ͨ��ALIPAY��¼���˺�
	public static function validateUserFromALI($uid)
	{
		$userInfo = self::getUserInfo($uid);

		if ($userInfo === false) {
			return false;
		}

		return array('validate' => strpos($userInfo['icsonid'], ALIPAY_ACCOUNT_PRE) === 0 ? true : false);

	}

	/**
	 * �ʺ�ת���ɵ�������Ӧ��ID
	 * @param string $account վ���ʺ�
	 * @param int    $type    ���� IUser::OPEN_ID_TYPE_
	 */
	public static function accountToOpenId($account, $type)
	{
		if ($type == self::OPEN_ID_TYPE_QQ) {
			$openId = preg_replace("/^" . QQ_ACCOUNT_PRE . "_" . "/i", "", $account);
			if (strcmp($openId, $account) == 0) { // û�б仯����ζ�Ų���OPENID��Ӧ���ʺ�
				return false;
			}

			return $openId;
		} else if ($type == self::OPEN_ID_TYPE_ALI) {
			$openId = preg_replace("/^" . ALIPAY_ACCOUNT_PRE . "/i", "", $account);
			if (strcmp($openId, $account) == 0) {
				return false;
			}

			return $openId;
		}

		return false;
	}

	/**
	 * ��������Ӧ��ID����վ���ʺ�
	 * @param string $openId openid
	 * @param int    $type   ���� IUser::OPEN_ID_TYPE_
	 */
	public static function openIdToAccount($openId, $type)
	{
		switch ($type) {
			case self::OPEN_ID_TYPE_QQ:
				return QQ_ACCOUNT_PRE . '_' . $openId;
			case self::OPEN_ID_TYPE_ALI:
				return ALIPAY_ACCOUNT_PRE . $openId;
			default:
				return $openId;
		}
	}

	//others : for erp sync
	public static function getModifiedIds($biz_name, $start, $end)
	{
		$LIMIT = 500;
		$ret = array();
		$biz_id = self::$UPDATE_BIZ_ID[$biz_name];
		$mysql = Config::getDB('icson_admin');
		$sql = "";

		if (!$mysql) {
			Logger::info(Config::$errMsg);
			self::$errCode = Config::$errCode;
			self::$errMsg = config::$errMsg;

			return false;
		}

		if ($biz_id == 1) {
			$sql = "SELECT `id`, `updatetime` FROM t_user_updatetime WHERE `bizid` = {$biz_id} AND updatetime <= {$end} AND updatetime >= {$start} order by updatetime asc limit {$LIMIT}";
		} else {
			$sql = "SELECT `id`, `uid`, `updatetime` FROM t_user_updatetime WHERE `bizid` = {$biz_id} AND updatetime <= {$end} AND updatetime >= {$start} order by updatetime asc limit {$LIMIT}";
		}
		$result = $mysql->getRows($sql);

		if (false === $result) {
			Logger::err('get data from sql fails' . $mysql->errMsg);
			self::$errCode = Config::$errCode;
			self::$errMsg = config::$errMsg;

			return false;
		} else {
			foreach ($result AS $item) {
				if ($biz_id == 1) {
					$ret[] = $item['id'];
				} else {
					$ret[] = array($item['uid'], $item['id']);
				}
			}

			$last = array_pop($result);
			$ret = array('endTime' => $last['updatetime'], 'ids' => $ret);
		}

		return $ret;
	}

	public static function updateUserModifyTime($id, $biz_name, $uid)
	{
		$now = time();
		$biz_id = self::$UPDATE_BIZ_ID[$biz_name];
		$mysql = Config::getDB('icson_admin');

		if ($biz_id != 1 && !isset($uid)) //invoice �� address���������Ҫ��uid
		{
			self::$errCode = 21;
			self::$errMsg = "$uid is not set";

			return false;
		}

		if ($biz_id == 1) {
			$uid = 0;
		}

		if (!$mysql) {
			Logger::info(Config::$errMsg);
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;

			return false;
		}

		$sql = "SELECT * FROM t_user_updatetime WHERE id = {$id} AND bizid = {$biz_id}";
		$result = $mysql->getRows($sql);

		if (false === $result) {
			Logger::err('get data from sql fails' . $mysql->errMsg);
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;

			return false;
		} else if (0 === count($result)) {
			$result = $mysql->insert('t_user_updatetime', array('id'=> $id, 'bizid'=> $biz_id, 'uid'=> $uid, 'updatetime'=> $now));
		} else {
			$result = $mysql->update('t_user_updatetime', array('updatetime' => $now), "id = {$id} AND bizid = {$biz_id}");
		}

		if (false === $result) {
			Logger::err('update data from sql fails' . $mysql->errMsg);
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;

			return false;
		}

		return $result;
	}

	//�жϿͻ��˲���ϵͳ����,���ò�ͬ��������ʽ
	public static function getOSType()
	{
		$agent = $_SERVER['HTTP_USER_AGENT'];
		$os = 'os_na';
		if (eregi('Mac', $agent) && eregi('PC', $agent)) {
			$os = 'os_mac';
		} else if (eregi('win', $agent) && (eregi('nt 6.0', $agent) || eregi('nt 6.1', $agent))) {
			$os = 'os_win7';
		} else if (eregi('win', $agent) && eregi('nt 5.1', $agent)) {
			$os = 'os_xp';
		} else {
			$os = 'os_na';
		}
		return $os;
	}

	//����IP��ַ��λ���ڳ��У���ѯ�Ƿ�֧�ֻ�������
	public static function isCashOnDelivery()
	{
		global $_WEBSITE_CFG;
		$ip = ToolUtil::getClientIP();
		if (!$ip)
			return false;

		$ipInfo = NetUtil::getCityByIp($ip); //array('prov' => substr($city,0,2),'city' => $city,'net' => $items[1]);
		if (!$ipInfo)
			return false;

		$codlist = isset($_WEBSITE_CFG[self::getSiteIdWrapper()]['cod']) ? $_WEBSITE_CFG[self::getSiteIdWrapper()]['cod'] : false;
		if (!$codlist)
			return false;

		foreach ($codlist as $value) {
			if ($value % 100 == 0) //ȫʡ֧�ֻ�������
			{
				if (substr($value, 0, 2) == $ipInfo['prov'])
					return true;
			} else if ($value == $ipInfo['city']) {
				return true;
			}
		}

		return false;
	}

	//��ȡ��ҳ3.0ҳͷLogo�Ե�������Ϣ
	public static function getShanDianSongInfo()
	{
		global $_CITY_WEBSIT_CFG, $_WEBSITE_CFG, $_Province2city;

		$timeList = isset($_CITY_WEBSIT_CFG[$_Province2city[IUser::getProvId()]]['shandiansong']) ? $_CITY_WEBSIT_CFG[$_Province2city[IUser::getProvId()]]['shandiansong'] : '';
		$ret = array('text' => '', 'hover' => '');
		if (empty($timeList)) {
			if (!isset($_WEBSITE_CFG[IUser::getSiteId()]['shandiansong'])) {
				return $ret;
			}
			$timeList = $_WEBSITE_CFG[IUser::getSiteId()]['shandiansong'];
		}


		if (empty($timeList)) return $ret;

		$tmp = explode(":", date("H:i"));
		$now = $tmp[0] * 3600 + $tmp[1] * 60;
		foreach ($timeList as $key=> $val) {
			$keys = explode("-", $key);

			$begin = explode(":", $keys[0]);
			$end = explode(":", $keys[1]);

			$from = $begin[0] * 3600 + $begin[1] * 60;
			$to = $end[0] * 3600 + $end[1] * 60;

			if ($now >= $from && $now < $to) {
				$ret = array('text'=> $val[0], 'hover'=> $val[1]);
				break;
			}
		}

		return $ret;
	}

	//��ȡ��վ������ʽ����
	public static function getCateClass($opt = array())
	{
		/*
		 * ��ͬ��վ��category_panel�ò�ͬ��class
		 * �Ϻ�(1)			 :cate_bd
		 * ����(1001)�㶫(2001):cate_bd cate_bd_bj
		 * ����(3001)		 :cate_bd cate_bd_hb
		 */
		$cate_site = 'cate_bd';
		$site_id = IUser::getSiteIdWrapper();
		if ('2001' == $site_id)
			$cate_site .= ' cate_bd_bj';
		else if ('3001' == $site_id)
			$cate_site .= ' cate_bd_hb';
		else if ('4001' == $site_id)
			$cate_site .= ' cate_bd_bj';
		else if ('5001' == $site_id)
			$cate_site .= ' cate_bd_hb';

		return $cate_site;
	}

	//��վ����
	public static function getNavList($opt = array())
	{
		$str = '';
		$opt = is_array($opt) ? $opt : array();

		$siteId = isset($opt['siteId']) ? $opt['siteId'] : self::getSiteIdWrapper(); //�人վ�� �� Wrapper ��������
		$currentPage = isset($opt['currentPage']) ? $opt['currentPage'] : '';
		$hotName = isset($opt['hotName']) && true === $opt['hotName'] ? true : false;

		$countDownName = '��ں�';
		$countDownId = 'nav_nightcountdown1';
		$countDownUrl = 'http://event.51buy.com/nightmarket.html';
		if (in_array(date('w'), array(0, 5, 6))) {
			$countDownName = '��ĩ���';
			$countDownId = 'nav_weekendsaleout';
			$countDownUrl = 'http://act.51buy.com/weekendmarket.html';
		}

		$CONFIG = array(
			'1'    => array(
				array('label' => '��ҳ', 'id' => 'nav_home', 'href' => 'http://www.51buy.com', 'hotName' => 'I.NAV.HOME', 'ytag' => '04000'),
				array('label' => '�ҵ��', 'id' => 'nav_appliance', 'href' => 'http://www.51buy.com/jiadian.html', 'hotName' => 'I.NAV.APPLIANCE', 'isHot' => true, 'ytag' => '04001'),
				//array('label' => 'װ����', 'id' => 'nav_diy', 'href' => 'http://act.51buy.com/recommend.html', 'hotName' => 'I.NAV.FABRICATE', 'ytag' => '04001'),
				//array('label' => '������', 'id' => 'nav_car', 'href' => 'http://act.51buy.com/carproduct.html', 'hotName' => 'I.NAV.CAR', 'ytag' => '04002'),
				//array( 'label' => '��Ī��', 'id' => 'nav_gift', 'href' => 'http://act.51buy.com/gift/index.html', 'hotName' => 'I.NAV.GIFT', 'ytag' => '04003'),
			),
			'1001' => array(
				array('label' => '��ҳ', 'id' => 'nav_home', 'href' => 'http://www.51buy.com', 'hotName' => 'I.NAV.HOME', 'ytag' => '04000'),
				array('label' => '�ҵ��', 'id' => 'nav_appliance', 'href' => 'http://www.51buy.com/jiadian.html', 'hotName' => 'I.NAV.APPLIANCE', 'isHot' => true, 'ytag' => '04001'),
				//array('label' => 'װ����', 'id' => 'nav_diy', 'href' => 'http://act.51buy.com/recommend.html', 'hotName' => 'I.NAV.FABRICATE', 'ytag' => '04001'),
				//array('label' => '������', 'id' => 'nav_car', 'href' => 'http://act.51buy.com/carproduct.html', 'hotName' => 'I.NAV.CAR', 'ytag' => '04002'),
				//array( 'label' => '��Ī��', 'id' => 'nav_gift', 'href' => 'http://act.51buy.com/gift/index.html', 'hotName' => 'I.NAV.GIFT', 'ytag' => '04003'),
				array('label' => '����', 'id' => 'nav_morning_market', 'href' => 'http://act.51buy.com/morningmarket.html', 'hotName' => 'I.NAV.MORNING', 'isHot' => true, 'ytag' => '04008'),
				array('label' => $countDownName, 'id' => $countDownId, 'href' => $countDownUrl, 'hotName' => 'I.NAV.DARK', 'ytag' => '04004'),
			),
			'2001' => array(
				array('label' => '��ҳ', 'id' => 'nav_home', 'href' => 'http://www.51buy.com', 'hotName' => 'I.NAV.HOME', 'ytag' => '04000'),
				array('label' => '�ҵ��', 'id' => 'nav_appliance', 'href' => 'http://www.51buy.com/jiadian.html', 'hotName' => 'I.NAV.APPLIANCE', 'isHot' => true, 'ytag' => '04001'),
				//array('label' => 'װ����', 'id' => 'nav_diy', 'href' => 'http://act.51buy.com/recommend.html', 'hotName' => 'I.NAV.FABRICATE', 'ytag' => '04001'),
				//array( 'label' => '��Ī��', 'id' => 'nav_gift', 'href' => 'http://act.51buy.com/gift/index.html', 'hotName' => 'I.NAV.GIFT'),
				//array('label' => '������', 'id' => 'nav_car', 'href' => 'http://act.51buy.com/carproduct.html', 'hotName' => 'I.NAV.CAR', 'ytag' => '04002'),
			),
			'3001' => array( //�人վ
				array('label' => '��ҳ', 'id' => 'nav_home', 'href' => 'http://www.51buy.com', 'hotName' => 'I.NAV.HOME', 'ytag' => '04000'),
				//array('label' => 'װ����', 'id' => 'nav_diy', 'href' => 'http://act.51buy.com/recommend.html', 'hotName' => 'I.NAV.FABRICATE', 'ytag' => '04001'),
				array('label' => '����', 'id' => 'nav_morning_market', 'href' => 'http://act.51buy.com/morningmarket.html', 'hotName' => 'I.NAV.MORNING', 'isHot' => true, 'ytag' => '04008'),
				array('label' => $countDownName, 'id' => $countDownId, 'href' => $countDownUrl, 'hotName' => 'I.NAV.DARK', 'ytag' => '04004'),
			),
			'4001' => array( //����վ
				array('label' => '��ҳ', 'id' => 'nav_home', 'href' => 'http://www.51buy.com', 'hotName' => 'I.NAV.HOME', 'ytag' => '04000'),
				//array('label' => 'װ����', 'id' => 'nav_diy', 'href' => 'http://act.51buy.com/recommend.html', 'hotName' => 'I.NAV.FABRICATE', 'ytag' => '04001'),
			),
			'5001' => array( //����վ
				array('label' => '��ҳ', 'id' => 'nav_home', 'href' => 'http://www.51buy.com', 'hotName' => 'I.NAV.HOME', 'ytag' => '04000'),
			),
		);

		if ($siteId != '1001' && $siteId != '3001') {
			$h = date("H");

			if ($h < 11) {
				array_push($CONFIG['1'], array('label' => '����', 'id' => 'nav_morning_market', 'href' => 'http://act.51buy.com/morningmarket.html', 'hotName' => 'I.NAV.MORNING', 'ytag' => '04008'));
				array_push($CONFIG['2001'], array('label' => '����', 'id' => 'nav_morning_market', 'href' => 'http://act.51buy.com/morningmarket.html', 'hotName' => 'I.NAV.MORNING', 'ytag' => '04008'));
				array_push($CONFIG['4001'], array('label' => '����', 'id' => 'nav_morning_market', 'href' => 'http://act.51buy.com/morningmarket.html', 'hotName' => 'I.NAV.MORNING', 'ytag' => '04008'));
				array_push($CONFIG['5001'], array('label' => '����', 'id' => 'nav_morning_market', 'href' => 'http://act.51buy.com/morningmarket.html', 'hotName' => 'I.NAV.MORNING', 'ytag' => '04008'));
			} else {
				array_push($CONFIG['1'], array('label' => '��ں�', 'id' => 'nav_nightcountdown1', 'href' => 'http://event.51buy.com/nightmarket.html', 'hotName' => 'I.NAV.MORNING', 'ytag' => '04008'));
				array_push($CONFIG['2001'], array('label' => '��ں�', 'id' => 'nav_nightcountdown1', 'href' => 'http://event.51buy.com/nightmarket.html', 'hotName' => 'I.NAV.MORNING', 'ytag' => '04008'));
				array_push($CONFIG['4001'], array('label' => '��ں�', 'id' => 'nav_nightcountdown1', 'href' => 'http://event.51buy.com/nightmarket.html', 'hotName' => 'I.NAV.MORNING', 'ytag' => '04008'));
				array_push($CONFIG['5001'], array('label' => '��ں�', 'id' => 'nav_nightcountdown1', 'href' => 'http://event.51buy.com/nightmarket.html', 'hotName' => 'I.NAV.MORNING', 'ytag' => '04008'));
			}

		}


		$_groupBuyUrl = ITuanLikeHistory::getTuanLink($siteId); //�㶫������վ�����Ź����
		if (!empty($_groupBuyUrl)) {
			array_push($CONFIG[$siteId], array('label' => '�Ź�', 'id' => 'nav_groupbuy', 'href' => $_groupBuyUrl, 'hotName' => 'I.NAV.GROUPBUY', 'isHot' => false, 'ytag' => '04007'));
		}

		array_push($CONFIG['1'], array('label' => '��������', 'id' => 'nav_second', 'href' => 'http://act.51buy.com/secondhand.html', 'hotName' => 'I.NAV.SECONDHAND', 'ytag' => '04006'));
		array_push($CONFIG['1001'], array('label' => '��������', 'id' => 'nav_second', 'href' => 'http://act.51buy.com/secondhand.html', 'hotName' => 'I.NAV.SECONDHAND', 'ytag' => '04006'));
		array_push($CONFIG['2001'], array('label' => '��������', 'id' => 'nav_second', 'href' => 'http://act.51buy.com/secondhand.html', 'hotName' => 'I.NAV.SECONDHAND', 'ytag' => '04006'));
		array_push($CONFIG['3001'], array('label' => '��������', 'id' => 'nav_second', 'href' => 'http://act.51buy.com/secondhand.html', 'hotName' => 'I.NAV.SECONDHAND', 'ytag' => '04006'));
		array_push($CONFIG['4001'], array('label' => '��������', 'id' => 'nav_second', 'href' => 'http://act.51buy.com/secondhand.html', 'hotName' => 'I.NAV.SECONDHAND', 'ytag' => '04006'));
		array_push($CONFIG['5001'], array('label' => '��������', 'id' => 'nav_second', 'href' => 'http://act.51buy.com/secondhand.html', 'hotName' => 'I.NAV.SECONDHAND', 'ytag' => '04006'));

		array_push($CONFIG['1'], array('label' => '����', 'id' => 'yeal_discover', 'href' => 'http://faxian.51buy.com', 'hotName' => 'I.NAV.DISCOVER','isHot' => true, 'ytag' => '04015'));
		array_push($CONFIG['1001'], array('label' => '����', 'id' => 'yeal_discover', 'href' => 'http://faxian.51buy.com', 'hotName' => 'I.NAV.DISCOVER','isHot' => true, 'ytag' => '04015'));
		array_push($CONFIG['2001'], array('label' => '����', 'id' => 'yeal_discover', 'href' => 'http://faxian.51buy.com', 'hotName' => 'I.NAV.DISCOVER','isHot' => true, 'ytag' => '04015'));
		array_push($CONFIG['3001'], array('label' => '����', 'id' => 'yeal_discover', 'href' => 'http://faxian.51buy.com', 'hotName' => 'I.NAV.DISCOVER','isHot' => true, 'ytag' => '04015'));
		array_push($CONFIG['4001'], array('label' => '����', 'id' => 'yeal_discover', 'href' => 'http://faxian.51buy.com', 'hotName' => 'I.NAV.DISCOVER','isHot' => true, 'ytag' => '04015'));
		array_push($CONFIG['5001'], array('label' => '����', 'id' => 'yeal_discover', 'href' => 'http://faxian.51buy.com', 'hotName' => 'I.NAV.DISCOVER','isHot' => true, 'ytag' => '04015'));

		array_push($CONFIG['1'], array('label' => '��ҵ�ػ�', 'id' => 'yeal_gift', 'href' => 'http://u.51buy.com/081ac7', 'hotName' => 'I.NAV.YEARGIFT','ytag' => '04016'));
		array_push($CONFIG['1001'], array('label' => '��ҵ�ػ�', 'id' => 'yeal_gift', 'href' => 'http://u.51buy.com/081ac7', 'hotName' => 'I.NAV.YEARGIFT', 'ytag' => '04016'));
		array_push($CONFIG['2001'], array('label' => '��ҵ�ػ�', 'id' => 'yeal_gift', 'href' => 'http://u.51buy.com/081ac7', 'hotName' => 'I.NAV.YEARGIFT', 'ytag' => '04016'));
		array_push($CONFIG['3001'], array('label' => '��ҵ�ػ�', 'id' => 'yeal_gift', 'href' => 'http://u.51buy.com/081ac7', 'hotName' => 'I.NAV.YEARGIFT', 'ytag' => '04016'));
		array_push($CONFIG['4001'], array('label' => '��ҵ�ػ�', 'id' => 'yeal_gift', 'href' => 'http://u.51buy.com/081ac7', 'hotName' => 'I.NAV.YEARGIFT', 'ytag' => '04016'));
		array_push($CONFIG['5001'], array('label' => '��ҵ�ػ�', 'id' => 'yeal_gift', 'href' => 'http://u.51buy.com/081ac7', 'hotName' => 'I.NAV.YEARGIFT', 'ytag' => '04016'));
		
		if (in_array(date('w'), array(0, 5, 6))) {
			array_push($CONFIG['1'], array('label' => '��ĩ���', 'id' => 'nav_weekendsaleout', 'href' => 'http://act.51buy.com/weekendmarket.html', 'hotName' => 'I.NAV.DARK', 'ytag' => '04004'));
			array_push($CONFIG['2001'], array('label' => '��ĩ���', 'id' => 'nav_weekendsaleout', 'href' => 'http://act.51buy.com/weekendmarket.html', 'hotName' => 'I.NAV.DARK', 'ytag' => '04004'));
			array_push($CONFIG['4001'], array('label' => '��ĩ���', 'id' => 'nav_weekendsaleout', 'href' => 'http://act.51buy.com/weekendmarket.html', 'hotName' => 'I.NAV.DARK', 'ytag' => '04004'));
			array_push($CONFIG['5001'], array('label' => '��ĩ���', 'id' => 'nav_weekendsaleout', 'href' => 'http://act.51buy.com/weekendmarket.html', 'hotName' => 'I.NAV.DARK', 'ytag' => '04004'));
		}

		/*if(!empty($siteId)){
			array_push($CONFIG[$siteId], array('label' => '��Ʒ��', 'id' => 'gift_card', 'href' => 'http://event.51buy.com/event/3897b957.html', 'hotName' => 'I.NAV.GIFTCARD', 'ytag' => '04017'));
		}*/

		$items = isset($CONFIG[$siteId]) ? $CONFIG[$siteId] : array();
		$count = count($items);

		foreach ($items as $index => $item) {
			$qqbuy_str = ($item['id'] == 'nav_qqbuy') ? ' target="_blank"' : '';

			$morTips = '';
			/*
			if ($siteId != 1001 && $siteId != 3001) {
				if ($item['id'] == 'nav_morning_market' || $item['id'] == 'nav_nightcountdown1') {
					$isCom = isset($_COOKIE['m_d_combine']) ? 1 : 0;
					$ts = strtotime("2013-02-25 00:00:00");
					$now = time();
					if (!$isCom && $now < $ts) {
						$morTips = '<div id="m_d_combine" class="merge_tip"><div class="mergin_inner">���к���ںںϲ�����<a href="#" onclick="__closeMDC();return false;">��֪����</a></div><div class="layout_arrow_bottom"> <span class="">��</span><i>��</i> </div></div>';
						$morTips .= '<script type="text/javascript">
						setTimeout(function(){
							$("#m_d_combine").hide();
							__closeForOnce();
						},3000);
						if(navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion .split(";")[1].replace(/[ ]/g,"")=="MSIE6.0") {
							$("#m_d_combine").hide();
						}
						if(navigator.appName == "Microsoft Internet Explorer" && navigator.appVersion .split(";")[1].replace(/[ ]/g,"")=="MSIE7.0") {
							$("#m_d_combine").hide();
						}
						function __closeMDC() {
							G.util.cookie.add(\'m_d_combine\', 1, \'/\', 2592000, \'.51buy.com\');
							$("#m_d_combine").hide();
						}
						function __closeForOnce() {
							G.util.cookie.add(\'m_d_combine\', 1, \'/\', 0, \'.51buy.com\');
							$("#m_d_combine").hide();
						}
						</script>';
					}
					
				}
			}
			*/
			$str .= '<li' . ($item['id'] === $currentPage ? ' class="current"' : '')
				. ' id="' . $item['id'] . '"><a href="' . $item['href'] . '"' . ($hotName ? ' hotName="' . $item['hotName'] . '"' : '') . ($item['ytag'] ? ' ytag="' . $item['ytag'] . '"' : '') . $qqbuy_str . '>'
				. $item['label'] . (!empty($item['isHot']) ? '<i class="dot_hot"><span class="hide_clip">��</span></i>' : '') . "</a>" . $morTips  . "</li>\n";
		}

		return $str;
	}

	private static function translate($name_, $item_, $MSSQL_)
	{
		if ('sex' === $name_) {
			return ('m' == $item_['sex']) ? 1 : (('f' == $item_['sex']) ? 0 : 2);
		}
		if ('regtime' === $name_ || 'updatetime' === $name_) {
			return date('Y-m-d H:i:s', $item_[$name_]);
		}
		if ('name' === $name_) {
			if (ToolUtil::hasMarsWord($item_[$name_])) {
				return '';
			}

			return $MSSQL_->msEscapeStr($item_[$name_]);
		}

		if ('email' === $name_ || 'address' === $name_ || 'note' === $name_) {
			return $MSSQL_->msEscapeStr($item_[$name_]);
		}

		return $item_[$name_];
	}

	/**
	 * �ж��û��Ƿ���QQ��Ա
	 * @param int $uid
	 */
	public static function checkQQVip($uid)
	{
		Global $_IP_CFG;
		//define('QQ_VIP_VALIDATE_KEY', '8ef8d1810b5e64898b996a423c78e7c7');
		$userInfo = self::getUserInfo($uid);
		return self::checkQQVipByIcsonID($userInfo['icsonid']);
	}


	public static function checkQQVipByIcsonID($icsonid)
	{
		Global $_IP_CFG;
		$openid = self::accountToOpenId($icsonid, IUser::OPEN_ID_TYPE_QQ);
		if ($openid) {
			$appid = OPENQQ_APPID;
			$appkey = '8ef8d1810b5e64898b996a423c78e7c7';
			$sign = md5('openid=' . $openid . '&appid=' . $appid . '&accesskey=' . $appkey);
			$svr_ip = $_IP_CFG['QQ_VIP'][rand(0, count($_IP_CFG['QQ_VIP']) - 1)];
			$url = 'http://' . $svr_ip . '/openapi/isclub.php?openid=' . $openid . '&appid=' . $appid . '&sign=' . $sign . '&realcheck=1';
			$checkRet = NetUtil::cURLHTTPGet(
				$url,
				3,
				'pf.vip.qq.com'
			);
			$i = 0;
			/*while (empty($checkRet)) {
				set_time_limit(30);
				Logger::info('vip qq get failure' . $i);
				$checkRet = NetUtil::cURLHTTPGet(
					$url,
					3,
					'pf.vip.qq.com'
				);
				if (!empty($checkRet)) {
					Logger::info('vip qq get success');
					Logger::info($checkRet);
					break;
				}
				if ($i > 5) {
					Logger::info('vip qq get failure 5');
					break;
				}
				$i++;
			}*/
			if (empty($checkRet)) {
				Logger::err(NetUtil::$errCode . ' : ' . NetUtil::$errMsg . " [$svr_ip]");
				return false;
			}
			$vipInfo = json_decode($checkRet);
			return $vipInfo->isclub > 0 ? true : false;
		}
		//Logger::err("Failed to convert openid witch account $icsonid.");
		return false;
	}
	
	public static function checkQQVipByMp($mp, $qq = '') {
		self::$errCode = 0;
		self::$errMsg = '';
		
		try {
		
			if(empty($qq)) {
				$uid = self::getLoginUid();
				if(empty($uid)) {
					throw new BaseException(ErrorConfig::getErrorCode('user_not_found'), 'Uid should not be emtpy.');
				}
				
				$user_info = self::getUserInfo($uid);
				if($user_info === false) {
					throw new BaseException(ErrorConfig::getErrorCode('user_not_found'), "Failed to get user information with uid $uid.");
				}
				
				$qq = self::getQQByAccount($user_info['icsonid']);
				if($qq === false) {
					throw new BaseException(ErrorConfig::getErrorCode('get_qq_failed'), "Failed to get qq with open id $open_id.");
				}
			}
			
			$vkey = md5($mp . $qq . md5('iyouxi_qqvip'));
			$url = "http://iyouxi.vip.qq.com/jsonp.php?_c=Info&f=lottchance&mp=$mp&uin=$qq&vkey=$vkey&t=" . time();
			
			$ret = NetUtil::cURLHTTPGet($url);
			// ���ظ�ʽ{"ret":0,"data":3,"time":1360897913}
			// retΪ�����룬0Ϊ������dataΪ��ͨ�Ĵ�����timeΪ�������յ�����ʱ��ʱ��
// 			if($ret === false) {
// 				// ����ʧ������һ��
// 				Logger::warn("Request failed with url $url.");
// 				$url = "http://iyouxi.vip.qq.com/jsonp.php?_c=Info&f=lottchance&mp=$mp&uin=$qq&vkey=$vkey&t=" . time();
// 				$ret = NetUtil::cURLHTTPGet($url);
				if($ret === false) {
					Logger::err("Request failed with url $url.");
					throw new BaseException(ErrorConfig::getErrorCode('net_error'), "Failed to check qq vip with url $url.");
				}
// 			}

			$ret_info = ToolUtil::gbJsonDecode($ret);
			if(empty($ret_info)) {
				throw new BaseException(ErrorConfig::getErrorCode('parse_error'), "Failed to parse return string $ret.");
			}
			
			if($ret_info['ret'] != 0) {
				// 33008	GET��ֵ��������(uin����mp����vkey)
				// 33009	������ʽ����ȷ��uin��mp��
				// 33010	vkey��֤ʧ��
				// -1		�Ҳ����ӿڣ�_c=Info&f=lottchance�ⲿ�ִ���
				throw new BaseException(ErrorConfig::getErrorCode('qq_vip_verify_error'), "Unexpected return : {$ret_info['ret']}.");
			}
			
			return $ret_info['data'];
		
		} catch(BaseException $e) {
			if(empty(self::$errCode)) {
				self::$errCode = $e->errCode;
				self::$errMsg = $e->errMsg;
			}
			return false;
		}
	}

	/**
	 * �ж��û��Ƿ��������Ա
	 * @param int $uid
	 * @author railszhu
	 */
	public static function checkQQGreen($uid)
	{
		Global $_IP_CFG;
		$userInfo = self::getUserInfo($uid);
		$account = $userInfo['icsonid'];
		$uin = self::getQQByAccount($account);
		$url = 'http://' . $_IP_CFG['QQ_GREEN'] . '/fcg-bin/fcg_music_getstate.fcg?uin=' . $uin;
		$host = 'qzone-music.qq.com';
		$checkRet = NetUtil::cURLHTTPGet($url, 2, $host);
		$i = 0;
		/*while (empty($checkRet)) {
			set_time_limit(30);
			Logger::info('green vip qq get failure' . $i);
			$checkRet = NetUtil::cURLHTTPGet($url, 2, $host);
			if (!empty($checkRet)) {
				Logger::info('green vip qq get success');
				Logger::info($checkRet);
				break;
			}
			if ($i > 5) {
				Logger::info('green vip qq get failure 5');
				break;
			}
			$i++;
		}*/
		if (empty($checkRet)) {
			return false;
		}
		preg_match('/state=\"\d\"/', $checkRet, $state);
		preg_match('/\d/', $state[0], $flag);
		return $flag[0] == 1 ? true : false;
	}

	//�ж�����
	public static function checkQQBlue($uid)
	{
		Global $_IP_CFG;
		$userInfo = self::getUserInfo($uid);
		$account = $userInfo['icsonid'];
		$uin = self::getQQByAccount($account);
		$url = "http://{$_IP_CFG['QQ_BLUE']}:8080/blue.php?uin=$uin&cmd=14110";

// 		for ($i = 0; $i < 5; $i++) {
// 			$checkRet = NetUtil::cURLHTTPGet($url, 2);
// 			if (!empty($checkRet))
// 				break;
// 		}

		$checkRet = NetUtil::cURLHTTPGet($url, 2);
		if (empty($checkRet)){
// 		if ($i == 5) {
			Logger::err("Failed to check blue member with uid $uid.");
			return false;
		}

		$result = array();
		$properties = explode('&', $checkRet);
		foreach ($properties as $p) {
			$tmp = explode('=', $p);
			$result[$tmp[0]] = $tmp[1];
		}

		return array(
			'isBlue'     => isset($result['result']) && $result['result'] == 0,
			'isYearBlue' => isset($result['annual']) && $result['annual'] == 1
		);
	}

	//�жϻ������ѻ���
	public static function checkQQYellow($uid)
	{
		Global $_IP_CFG;
		$userInfo = self::getUserInfo($uid);
		$account = $userInfo['icsonid'];
		$uin = self::getQQByAccount($account);
		$openid = self::accountToOpenId($account, self::OPEN_ID_TYPE_QQ);
		$ttc_key = "access_token_$openid";
		$access_token = IPageCahce::getCacheData($ttc_key);

		if (empty($access_token)) {
			Logger::err("Failed to get access token with uid $uid.");
			return false;
		}

		$url = 'https://' . $_IP_CFG['QQ_YELLOW'] . '/user/get_user_info'
			. '?access_token=' . $access_token
			. '&oauth_consumer_key=' . OPENQQ_APPID
			. '&openid=' . $openid
			. '&format=json';
// 		for ($i = 0; $i < 5; $i++) {
// 			$checkRet = NetUtil::cURLHTTPGet($url, 2, 'graph.qq.com');
// 			if (!empty($checkRet))
// 				break;
// 		}

		$checkRet = NetUtil::cURLHTTPGet($url, 2, 'graph.qq.com');
		if (empty($checkRet)){
// 		if ($i == 5) {
			Logger::err("Failed to check yellow member with uid $uid.");
			return false;
		}

		$userYellowInfo = json_decode($checkRet, true);
		return array(
			'isVip'     => $userYellowInfo['vip'] == '1',
			'isYearVip' => $userYellowInfo['is_yellow_year_vip'] == '1'
		);
	}

	/**
	 * �ж��û��Ƿ�����ѻ�Ա
	 * @param int $uid
	 * @author railszhu
	 */
	public static function checkQQVipIsYear($uid)
	{
		Global $_IP_CFG;
		$userInfo = self::getUserInfo($uid);
		$openid = self::accountToOpenId($userInfo['icsonid'], IUser::OPEN_ID_TYPE_QQ);
		if ($openid) {
			$appid = OPENQQ_APPID;
			$appkey = '8ef8d1810b5e64898b996a423c78e7c7';
			$sign = md5('openid=' . $openid . '&appid=' . $appid . '&accesskey=' . $appkey);
			$url = 'http://' . $_IP_CFG['QQ_YEAR_VIP'] . '/common/isyear.php?openid=' . $openid . '&appid=' . $appid . '&sign=' . $sign;
			$host = 'iyouxi.vip.qq.com';
			$checkRet = NetUtil::cURLHTTPGet($url, 2, $host);
			$i = 0;
			/*while (empty($checkRet)) {
				set_time_limit(30);
				Logger::info('year vip qq get failure' . $i);
				$checkRet = NetUtil::cURLHTTPGet($url, 2, $host);
				if (!empty($checkRet)) {
					Logger::info('year vip qq get success');
					Logger::info($checkRet);
					break;
				}
				if ($i > 5) {
					Logger::info('year vip qq get failure 5');
					break;
				}
				$i++;
			}*/
			if (empty($checkRet)) {
				return false;
			}
			$yearVipInfo = json_decode($checkRet);
			return $yearVipInfo->isyear == 1 ? true : false;
		}
		return false;
	}

	/**
	 * ����QQ�ŵõ�openid
	 * @param int   $QQ
	 * @param sting $skey
	 * @return int
	 */
	public static function getOpenidByQQ($QQ)
	{
		Global $_IP_CFG;
		$ts = time();
		$uin = $QQ;
		//		$id = 'icson';
		//		$key = 'sd&#_lksdfYYTsdfL__+*7';
		//		$sn = md5($uin . $id . $key . md5($key . $uin . $key));
		//$url = "http://a1.shop.qq.com/act.php?mod=checkuser&func=openid&id=$id&qq=$uin&ts=$ts&sn=$sn&skey=$skey";
		$url = "http://" . $_IP_CFG['QQ_OPENID'] . ":8080/openid/decopenid.php?func=getopenidbyuin&uin=" . $uin;
		$checkRet = NetUtil::cURLHTTPGet(
			$url
		);
		if (empty($checkRet)) {
			return false;
		}
		$ret = json_decode($checkRet);
		for ($i = 0; $i < 5; $i++) {
			if (!empty($ret->openid)) {
				break;
			}
		}

		if (empty($ret->openid)) {
			return 0;
		}

		return trim($ret->openid);
	}
	
	/**
	 * ����QQ�ŵõ��û�uid
	 * @param int   $QQ
	 * @param sting $skey
	 * @return int
	 */
	public static function getUidByQQ($QQ, $skey)
	{
		Global $_IP_CFG;
		$ts = time();
		$uin = $QQ;
//		$id = 'icson';
//		$key = 'sd&#_lksdfYYTsdfL__+*7';
//		$sn = md5($uin . $id . $key . md5($key . $uin . $key));
		//$url = "http://a1.shop.qq.com/act.php?mod=checkuser&func=openid&id=$id&qq=$uin&ts=$ts&sn=$sn&skey=$skey";
		$url = "http://" . $_IP_CFG['QQ_OPENID'] . ":8080/openid/decopenid.php?func=getopenidbyuin&uin=" . $uin;
		$checkRet = NetUtil::cURLHTTPGet(
			$url
		);
		if (empty($checkRet)) {
			return false;
		}
		$ret = json_decode($checkRet);
		for ($i = 0; $i < 5; $i++) {
			if (!empty($ret->openid)) {
				break;
			}
		}

		if (empty($ret->openid)) {
			return 0;
		}
		$account = QQ_ACCOUNT_PRE . '_' . trim($ret->openid);
// 		$item = self::_getTTCInfo("IIcsonLoginTTC", $account);
		$item = self::getUserInfoByAccount($account);
		if (empty($item) || empty($item[0]['uid'])) {
			self::_loginqq_autouser(trim($ret->openid), '12345678');
// 			$item = self::_getTTCInfo("IIcsonLoginTTC", $account);
			$item = self::getUserInfoByAccount($account);
		}
		return empty($item) ? 0 : $item[0]['uid'];
	}

	/**
	 * ����account�õ�QQ��
	 * @param sting $account
	 * @return int
	 */
	public static function getQQByAccount($account)
	{
		Global $_IP_CFG;

		$url = "http://" . $_IP_CFG['QQ_OPENID'] . ":8080/openid/decopenid.php?func=getuinbyopenid&openid=" . $account;
		$checkRet = NetUtil::cURLHTTPGet(
			$url
		);
		if (empty($checkRet)) {
			return false;
		}
		$ret = json_decode($checkRet);
		for ($i = 0; $i < 5; $i++) {
			if (!empty($ret->openid)) {
				break;
			}
		}

		if (empty($ret->uin)) {
			return 0;
		}
		return $ret->uin;
	}

	public static function _loginqq_autouser($openID, $password, $nickname = '')
	{
		$message = '��¼ʧ��';
		$account = QQ_ACCOUNT_PRE . '_' . $openID; // ��ID�м�����һ���»���
		$exists = IUser::checkIcsonAccountExist($account);
		if ($exists === false) {
			Logger::err("user_loginqq IUser::checkIcsonAccountExist failed-" . IUser::$errCode . '-' . IUser::$errMsg);
			TemplateHelper::outMessage($message);
			return false;
		}

		$clientIp = ToolUtil::getClientIP();
		if ($exists['exist'] == 0) {
			$email = '';

			$regSrc = empty($_COOKIE['us']) ? '' : $_COOKIE['us'];
			$userData = array(
				'email'       => $email,
				'regIP'       => $clientIp,
				'warehouseId' => IUser::getSiteId(),
				'source'      => $regSrc
			);
			$register = IUser::register($account, $password, $userData);
			if ($register === false) {
				if (IUser::$errCode != 10303) {
					// �ظ�key���ɳɹ�
					Logger::err("user_loginqq IUser::register failed-" . IUser::$errCode . '-' . IUser::$errMsg);
					TemplateHelper::outMessage($message);
					return false;
				}
			}
			// ��Ϣһ�� ��������login�ᱨ��
			// ��Ҫ��һ���Ż������������������
// 			sleep(1);
		}

		$session = IUser::login($account, $password, $clientIp, 1, 3);
		if ($session === false) {
			Logger::err("IUser::login failed-" . IUser::$errCode . '-' . IUser::$errMsg);
			TemplateHelper::outMessage($message);
			return false;
		}

		setrawcookie("QQACCT", $openID, 0, '/', '.51buy.com');
		setrawcookie("new_u", false, 1, '/', '.51buy.com');

		$user = IUser::getUserInfo($session['uid']);
		if ($user === false) {
			Logger::err("IUser::getUserInfo failed-" . IUser::$errCode . '-' . IUser::$errMsg);
			TemplateHelper::outMessage($message);
			return false;
		} else if (isset($user['exp_point']) && $user['exp_point'] <= 0) {
			setrawcookie("new_u", '1', 0, '/', '.51buy.com'); //�������û�cookie
		}

		setrawcookie("uid", $session['uid'], 0, '/', '.51buy.com');
		setrawcookie("skey", $session['skey'], 0, '/', '.51buy.com', false, true);

		setrawcookie("qq_nick", $session['uid'] . '|' . ToolUtil::escape($nickname), 0, '/', '51buy.com');
		//���QQ tips�������������֤��Ϣ
		if (isset($_GET['key'])) {
			if ((substr(md5($openID . "icson@qq"), 0, 6) != $_GET['key'])) {
				TemplateHelper::outMessage(array("�Բ����������ϲμӴ˻������", '<a href="http://www.51buy.com">�ص���Ѹ��ҳ</a>'));
				return false;
			} else {
				setrawcookie("edm_key", $_GET['key'], 0, '/', '.51buy.com');
			}
		}
	}

	public static function checkSiteIdAndPrId()
	{
		if (isset($_COOKIE[self::$siteKey]) && isset($_COOKIE[self::LOCATION_COOKIE])) {
			$siteId = $_COOKIE[self::$siteKey];
			$prId = $_COOKIE[self::LOCATION_COOKIE];
			$prIds = explode("_", $prId);
			global $_ProvinceToWhid;

			self::$provId = $prIds[1];

			if (!isset($_ProvinceToWhid[$prIds[1]]) || $_ProvinceToWhid[$prIds[1]] != $siteId) {
				$provIdNew = 0;
				foreach ($_ProvinceToWhid as $prov => $st) {
					if ($siteId == $st) {
						$provIdNew = $prov;
						break;
					}
				}

				global $PROVINCEID_MAP_DEFAULT_PRID;
				$locId = $PROVINCEID_MAP_DEFAULT_PRID[$provIdNew];
				self::$provId = $provIdNew;
				setcookie(self::LOCATION_COOKIE, $locId . '_' . $provIdNew, time() + self::$siteKeyExpires, '/', '.51buy.com');
			}
		}
	}


    /**����û��Ƿ��Ѿ����ֻ�
     * @param $uid int
     */
    public static function checkUidIsBindMobile($uid){
        if ($uid <= 0) {
            self::$errCode = 10;
            self::$errMsg = basename(__FILE__, '.php') . ' |' . __LINE__ . '[uid is invalid]';
            return false;
        }
        //��ȡ�û���Ϣ�е��ֻ���
//         $user_info = IUsersTTC::get($uid);
		$user_info = self::getUsersTTC($uid);
        if(flase === $user_info){
            self::$errCode = IUsersTTC::$errCode;
            self::$errMsg = basename(__FILE__, '.php') . ' |' . __LINE__ . IUsersTTC::$errMsg;
            return false;
        }
        if(empty($user_info[0]['mobile'])){
            return false;
        }
        //��֤���ֻ����Ƿ��Ѿ���
//         $tel_info = ITelLoginTTC::get($user_info[0]['mobile'],array('status'=>1));
        $tel_info = self::getTelLoginByMobile($user_info[0]['mobile'], $uid, false, true);
        if(flase === $tel_info){
            self::$errCode = ITelLoginTTC::$errCode;
            self::$errMsg = basename(__FILE__, '.php') . ' |' . __LINE__ . ITelLoginTTC::$errMsg;
            return false;
        }
        if(empty($tel_info)){
            return false;
        }
        return true;
    }

	/**
	 *
	 * �жϸ��û��Ƿ������û�
	 * @param $uid int �û�id
	 * @throws BaseException
	 */
	public static function isNewUser($uid){
		if($uid <= 0){
			self::$errCode = 1001;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . '[uid is invalid]';
			return false;
		}

// 		$user = IUsersTTC::get($uid, array(), array('exp_point'));
		$user = self::getUsersTTC($uid);
		if(false === $user){
			self::$errCode = IUsersTTC::$errCode;
			self::$errMsg = IUsersTTC::$errMsg . basename(__FILE__, '.php') . " |" . __LINE__ . '[uid is invalid]';
			return false;
		}

		if(empty($user)){
			self::$errMsg = "no search user";
			self::$errCode = 1002;
			return false;
		}

		if(!empty($user)){
			$exp_point = $user[0]['exp_point'];
			if($exp_point <= 1){//����ֵС�ڵ���1Ϊ���û�
				return true;
			}
		}

		return false;
	}
	
	/*
	 * ��ȡ�û������Ϣ���ҶȽӿڣ�����������ֱ�Ӷ�ȡͳһ��̨�����ݣ�����������Ļ��Ƕ�ȡ��վttc��
	 */
	public static function getUsersTTC($uid){
		$userInfo = false;
		if(self::ifInGray($uid)){
			$userInfo = UserWg::GetUserInfoByIcsonUid($uid);
		}else{
			$userInfo = self::_getTTCInfo("IUsersTTC", $uid);
		}
		return $userInfo;
	}
	
	
	/*
	 * ��ȡ�û������Ϣ���ҶȽӿڣ�����������ֱ�Ӷ�ȡͳһ��̨�����ݣ�����������Ļ��Ƕ�ȡ��վttc��
	*/
// 	public static function getUsersTTC($uid){
// 		$userInfo = false;
// 		if(self::ifInGray($uid)){
// 			$userInfo = UserWg::GetUserInfoByIcsonUid($uid);
// 		}else{
// 			$userInfo = self::_getTTCInfo("IUsersTTC", $uid);
// 		}
// 		return $userInfo;
// 	}
	
	/*
	 * ��ȡ����󶨱����Ϣ���ҶȽӿڣ�����������ֱ�Ӷ�ȡͳһ��̨�����ݣ�����������Ļ��Ƕ�ȡ��վttc��
	*/
	public static function getEmailLoginByEmail($email, $uid = 0, $ttcNeedUid=false,$ttcNeedStatus=false){
		$emailInfo = false;
		if(self::ifInGray($uid)){
			global $_BindInfoType;
			$userInfo = UserWg::GetUserInfoByBindInfo($_BindInfoType['email'], $email);
			if($userInfo !== false){
				if(!empty($userInfo)){
					$emailInfo =  array(array('uid'=>$userInfo[0]['uid'],'status'=>1,'updatetime'=>$userInfo[0]['updatetime'],'email'=>$email));
				}else{
					$emailInfo = array();
				}
			}
		}else{
			if($ttcNeedUid){
				$emailInfo = self::_getTTCInfo("IEmailLoginTTC", $email, array('uid' => $uid));
			}else if($ttcNeedStatus){
				global $_EmailStat;
				$emailInfo = self::_getTTCInfo("IEmailLoginTTC", $email, array('status' => $_EmailStat['bound']));
			}else{
				$emailInfo = self::_getTTCInfo("IEmailLoginTTC", $email);
			}
		}
		return $emailInfo;
	}
	
	/*
	 * ��ȡ�ֻ��󶨱����Ϣ���ҶȽӿڣ�����������ֱ�Ӷ�ȡͳһ��̨�����ݣ�����������Ļ��Ƕ�ȡ��վttc��
	*/
	public static function getTelLoginByMobile($mobile, $uid = 0, $ttcNeedUid=false,$ttcNeedStatus=false){
		$mobileInfo = false;
		if(self::ifInGray($uid)){
			global $_BindInfoType;
			$userInfo = UserWg::GetUserInfoByBindInfo($_BindInfoType['mobile'], $mobile);
			if($userInfo !== false){
				if(!empty($userInfo)){
					$mobileInfo =  array(array('uid'=>$userInfo[0]['uid'],'status'=>1,'updatetime'=>$userInfo[0]['updatetime'],'mobile'=>$mobile));
				}else{
					$mobileInfo = array();
				}
			}
		}else{
			if($ttcNeedUid){
				$mobileInfo = self::_getTTCInfo("ITelLoginTTC", $mobile, array('uid' => $uid));
			}else if($ttcNeedStatus){
				global $_MobileStat;
				$mobileInfo = self::_getTTCInfo("ITelLoginTTC", $mobile,array('status'=>$_MobileStat['bound']));
			}else{
				$mobileInfo = self::_getTTCInfo("ITelLoginTTC", $mobile);
			}
		}
		return $mobileInfo;
	}
	
	/*
	 * ��ȡ�ֻ��󶨱����Ϣ���ҶȽӿڣ�����������ֱ�Ӷ�ȡͳһ��̨�����ݣ�����������Ļ��Ƕ�ȡ��վttc��
	*/
	public static function getUserInfoByAccount($account,$qq=0){
		global $_AccountType;
		$userInfo = false;
// 		$userInfo = self::_getTTCInfo("IIcsonLoginTTC", $account);
		$accountType = $_AccountType['custom'];
		if($qq != 0){
			$accountType = $_AccountType['qq'];
		}else if(stripos($account, QQ_ACCOUNT_PRE) === 0){
			$accountType = $_AccountType['qq'];
		}
		$userInfo = UserWg::GetUserInfoByQQorAccount($accountType, $account, $qq);
		return $userInfo;
	}

	/**
	 * edit by hut bindEmailNew();
	 * �û���email,�û���дemail��������߼��������������İ󶨣�����email���뷴���
	 * ����false������
	 * ����1 �� �����email�ѱ�ռ��
	 * ����2��    ���û��Ѿ����˸�email�������ٰ�
	 * ����3��    ���û��Ѿ���������email����Ҫ�Ƚ��
	 */
	public static function bindEmailNew($uid, $email)
	{
		global $_EmailStat;

		$ret = self::checkEmailAndUid($uid, $email);
		if (false === $ret) {
			return false;
		}
		//�ȿ�email�Ƿ��б����ʸ�

		//$item = self::_getTTCInfo("IEmailLoginTTC", $email);
		$item = self::getEmailLoginByEmail($email, $uid);
		if ($item === false)
			return false;

		//�����email�Ѿ����˰���
		if (count($item) > 0 && ($item[0]['status'] == $_EmailStat['bound'])) {
			if ($item[0]['uid'] == $uid) //�Լ���
			{
				self::$errMsg = "���Ѿ��󶨸�Email";
				self::$errCode = 26;
				return false;
			} else {
				self::$errMsg = "��Email�Ѿ���ռ��";
				self::$errCode = 25;
				return false;
			}
		}

		//$email�а��ʸ�
		//$userOldInfo = self::_getTTCInfo("IUsersTTC", $uid);
		$userOldInfo = self::getUsersTTC($uid);
		if (false === $userOldInfo || count($userOldInfo) != 1) {
			return false;
		}

		$now = time();
		$userOldInfo = $userOldInfo[0];
		//old info��Ϊ�� ��Ϊ ��ͬmail
		if ($userOldInfo['email'] != $email) {
			if ($userOldInfo['email'] != "" && $userOldInfo['email'] != NULL) {

				//$item = self::_getTTCInfo("IEmailLoginTTC", $userOldInfo['email']);
				$item = self::getEmailLoginByEmail($userOldInfo['email'], $uid);
				if (false === $item) {
					return false;
				}
				if (count($item) != 0 && $item[0]['status'] == $_EmailStat['bound']) {
					self::$errMsg = "�û��Ѿ�����һ��Email�����Ƚ��";
					self::$errCode = 28;
					return false;
				}
			}
		}

		//����û���д����һ���µ�EMAIL
		if ($userOldInfo['email'] != $email) {

			if (false === self::_getDB($uid, "users", $mysql, $index, __LINE__))
				return false;

			$ret = $mysql->execSql("begin");
			if ($ret === false) {
				self::$errMsg = basename(__FILE__, 'php') . " | Line: " . __LINE__ . " start transaction error!" . $mysql->errMsg;
				return false;
			}

			$data = array('email'=> $email, 'updatetime'=> $now);
			if (false === self::_update($uid, "t_users_", $mysql, $index, $data, "uid=$uid", __LINE__))
				return false;

			if (false === self::_getDB2($email, "email_login", $mysql, $index, __FILE__))
				return;

			$data = array('email'=> $email, 'uid'=> $uid, 'status'=> $_EmailStat['normal'], 'updatetime'=> $now);
			if (false === self::_insert($uid, "t_email_login_", $mysql, $index, $data, __LINE__)){
				if(self::$errCode == 10303){
					if (false === self::_update($uid, "t_email_login_", $mysql, $index, $data, "email='".$email."'", __LINE__))
						return false;
				}
			}


			//$data = array('email'=> $email, 'uid'=> $uid, 'status'=> $_EmailStat['normal'], 'updatetime'=> $now);
			//if (false === self::_insert($uid, "t_email_login_", $mysql, $index, $data, __LINE__))
				//return;

			if ($userOldInfo['email'] != '') {
				if (false === self::_getDB2($userOldInfo['email'], "email_login", $mysql, $index, __FILE__))
					return;

				if (false === self::_remove($uid, "t_email_login_", $mysql, $index, "uid=$uid and email='{$userOldInfo['email']}'", __LINE__))
					return;
			}

			$erpDb = ToolUtil::getMSDBObj('Customer');
			if (false === $erpDb) {
				self::$errCode = ToolUtil::$errCode;
				self::$errMsg = ToolUtil::$errMsg;
				$mysql->execSql("rollback");
				return false;
			}

			$ret = $erpDb->update("Customer", array('SysNo'=> $uid, 'Email'=> $email, 'EmailStatus'=> $_EmailStat['normal'], 'rowModifyDate'=> date('Y-m-d H:i:s')), "SysNo=$uid");
			if (false === $ret) {
				self::$errCode = $erpDb->errCode;
				self::$errMsg = $erpDb->errMsg;
				$sql = "rollback";
				$mysql->execSql($sql);
				return false;
			}

			$mysql->execSql("commit");

			self::_purgeData4StrV2("IEmailLoginTTC", $userOldInfo['email']);
			self::_purgeData4StrV2("IEmailLoginTTC", $email);
			self::_purgeData4Int("IUsersTTC", $uid);
			
			$newInfo = array('email'=>$email);
			UserWg::updateUserWg($uid, $newInfo);

		}
		////�����ʼ�,�ʼ�EMAIL�а���get����Ϊ��code=xxxxxx
		//$code = IVerify::getEmailVerifyCode($uid, $email);
		//if (false === $code) {
			//self::$errCode = IVerify::$errCode;
			//self::$errMsg = IVerify::$errMsg;
			//return false;
		//}
		//$url = "http://base.51buy.com/index.php?mod=user&act=validateemail&uid=$uid&email=$email&code=$code";
		//Logger::info("bind sendEmail url:".$url);
		//$ret = IMessage::sendEmail($email, "������", $url);
		//if (false === $ret) {
			//self::$errCode = IMessage::$errCode;
			//self::$errMsg = IMessage::$errMsg;
			//return false;
		//}
		return true;
	}
}
