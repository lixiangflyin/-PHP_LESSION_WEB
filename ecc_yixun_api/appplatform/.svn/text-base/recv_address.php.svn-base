<?php
require_once('icsonrecvaddressao_php5_stub.php');
if (!defined("PHPLIB_ROOT")) {
	define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}
require_once(PHPLIB_ROOT . "lib/Config.php");
require_once(PHPLIB_ROOT . 'lib/ToolUtil.php');

//常量
define('AUTHKEY', "b14a070d");
define('AREA_ID_GB', 1);// 国标区域ID
define('AREA_ID_ICSON', 2);// 易迅区域ID
define('AREA_ID_GB_EXTEND', 3);// 国标扩展ID

Logger::init();

/**
 * 收货地址的服务化接口
 * @author wallechen
 *
 */
class RecvAddress
{
	const callerName = 'recv_address';
	
	public static $errMsg = "";
	public static $errCode = 0;
	
	public static function delRecvAddr($uid, $aid)
	{
		//Logger::info("delRecvAddr input: uid=$uid, aid=$aid");
		if (!isset($uid) || $uid <= 0){
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid为空';
			return false;
		}

		if (!isset($aid) || $aid <= 0){
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'aid为空';
			return false;
		}

		$ret = WebStubCntl2::request('b2b2c\icson_recvaddr\ao\DelIcsonRecvAddr',
			array(
				'opt' => array(
					'uin' => $uid,
					'operator' => $uid,
					'caller' => self::callerName,
					'itil' => '634184|634185|634186'
				),
				'req' => array(
					'machineKey' => ToolUtil::getClientIP(),
					'source' =>  __FILE__,
					'sceneId' => 0,
					'authKey' => AUTHKEY,
					'icsonUid' => $uid,
					'icsonAid' => $aid
				)
			)
		);
		
		if($ret['code'] != 0){
			Logger::err("delRecvAddr failed, uid=$uid, code=" . $ret['code'] . ', errmsg: ' . $ret['msg']);
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'DelIcsonRecvAddr failed';
			return false;
		}
		return true;
	}
	
	public static function addRecvAddr($uid, $newAddr)
	{
		//Logger::info("addRecvAddr input: uid=$uid, newAddr: " . var_export($newAddr, true));
		if (!isset($uid) || $uid <= 0) {
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid为空';
			return false;
		}

		if (!self::checkField($uid, $newAddr)){
			self::$errMsg = basename(__FILE__, '.php') . " | Line: " . __LINE__ . '地址参数不正确';
			return false;
		}

		// 检查非法字符
		if (!self::checkIsValidAddressData($newAddr)) {
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '地址字段不正确';
			return false;
		}

		$newAddr['uid'] = $uid;
		$newAddrPo = self::arrayToRecvAddrPo($newAddr);
		
		//Logger::info('here');
		$ret = WebStubCntl2::request('b2b2c\icson_recvaddr\ao\AddIcsonRecvAddr',
			array(
				'opt' => array(
					'uin' => $uid,
					'operator' => $uid,
					'caller' => self::callerName,
					'itil' => '634187|634188|634189'
				),
				'req' => array(
					'machineKey' => ToolUtil::getClientIP(),
					'source' =>  __FILE__,
					'sceneId' => 0,
					'authKey' => AUTHKEY,
					'icsonUid' => $uid,
					'icsonRecvAddrPo' => $newAddrPo
				)
			)
		);
		//Logger::info('get ret: ' . var_export($ret, true));
		
		if($ret['code'] != 0){
			Logger::err("addRecvAddr failed, uid=$uid, code=" . $ret['code'] . ', errmsg: ' . $ret['msg'] . ', test!');
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'AddIcsonRecvAddr failed';
			return false;
		}
		
		$newAid = self::getLatestAid($uid);
		return $newAid;
	}
	
	public static function getLatestAid($uid)
	{
		$ret = self::getRecvAddr($uid);
		$createtime = 0;
		$aid = 0;
		foreach($ret as $addr){
			if($addr['createtime'] > $createtime){
				$aid = $addr['aid'];
			}
		}
		return $aid;
	}
	
	public static function getRecvAddr($uid, $aid = 0)
	{
		//Logger::info('get input: uid=' . $uid);
		if (!isset($uid) || $uid <= 0) {
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid为空';
			return false;
		}
		
		$ret = WebStubCntl2::request('b2b2c\icson_recvaddr\ao\GetIcsonRecvAddr',
			array(
				'opt' => array(
					'uin' => $uid,
					'operator' => $uid,
					'caller' => self::callerName,
					'itil' => '634181|634182|634183'
				),
				'req' => array(
					'machineKey' => ToolUtil::getClientIP(),
					'source' =>  __FILE__,
					'sceneId' => 0,
					'icsonUid' => $uid
				)
			)
		);
		//Logger::info('get ret: ' . var_export($ret, true));
		if($ret['code'] == 3458){
			return array();
		}
		else if($ret['code'] != 0){
			Logger::err("getRecvAddr failed, uid=$uid, code=" . $ret['code'] . ', errmsg: ' . $ret['msg']);
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'GetIcsonRecvAddr failed';
			return false;
		}
		else{
			$ret = self::recvAddrPoToArray($ret['data']);
			//Logger::info('ret: ' . var_export($ret, true));
			return $ret;
		}
	}
	
	public static function modifyRecvAddr($uid, $newAddr)
	{
		//Logger::info("modifyRecvAddr input: uid=$uid, newAddr: " . var_export($newAddr, true));
		if (!isset($uid) || $uid <= 0) {
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'uid为空';
			return false;
		}
		
		if (!isset($newAddr) || count($newAddr) == 0) {
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'newAddr为空';
			return false;
		}
		
		// 检查字段
		if (!self::checkField($uid, $newAddr))
			return false;
		
		// 检查非法字符
		if (!self::checkIsValidAddressData($newAddr)) {
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'newAddr不合法';
			return false;
		}
		
		$newAddr['uid'] = $uid;
		$newAddrPo = self::arrayToRecvAddrPo($newAddr);
		$ret = WebStubCntl2::request('b2b2c\icson_recvaddr\ao\MofidyIcsonRecvAddr',
			array(
				'opt' => array(
					'uin' => $uid,
					'operator' => $uid,
					'caller' => self::callerName,
					'itil' => '634190|634191|634192'
				),
				'req' => array(
					'machineKey' => ToolUtil::getClientIP(),
					'source' =>  __FILE__,
					'sceneId' => 0,
					'authKey' => AUTHKEY,
					'newIcsonRecvAddrPo' => $newAddrPo
				)
			)
		);
		//Logger::info('get ret: ' . var_export($ret, true));
		
		if($ret['code'] != 0){
			Logger::err("modRecvAddr failed, uid=$uid, code=" . $ret['code'] . ', errmsg: ' . $ret['msg']);
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'ModifyIcsonRecvAddr failed';
			return false;
		}
		
		return true;
	}

	private static function arrayToRecvAddrPo($newAddr)
	{
		$recvAddrPo = array();
	
		if(!empty($newAddr['aid'])){
			$recvAddrPo['icsonAid'] = $newAddr['aid'];
			$recvAddrPo['icsonAid_u'] = 1;
		}
		$recvAddrPo['icsonUid'] = $newAddr['uid'];
		$recvAddrPo['icsonUid_u'] = 1;
		$recvAddrPo['name'] = $newAddr['name'];
		$recvAddrPo['name_u'] = 1;
		if(!empty($newAddr['mobile'])){
			$recvAddrPo['mobile'] = $newAddr['mobile'];
			$recvAddrPo['mobile_u'] = 1;
		}
		if(!empty($newAddr['phone'])){
			$recvAddrPo['phone'] = $newAddr['phone'];
			$recvAddrPo['phone_u'] = 1;
		}
		
		$recvAddrPo['districtIdMap'] = array(AREA_ID_ICSON => intval($newAddr['district']));
		$recvAddrPo['districtIdMap_u'] = 1;
		$recvAddrPo['address'] = $newAddr['address'];
		$recvAddrPo['address_u'] = 1;
		if(!empty($newAddr['sortfactor'])){
			$recvAddrPo['sortfactor'] = $newAddr['sortfactor'];
			$recvAddrPo['sortfactor_u'] = 1;
		}
		if(!empty($newAddr['fax'])){
			$recvAddrPo['fax'] = $newAddr['fax'];
			$recvAddrPo['fax_u'] = 1;
		}
		if(!empty($newAddr['zipcode'])){
			$recvAddrPo['zipCode'] = $newAddr['zipcode'];
			$recvAddrPo['zipCode_u'] = 1;
		}
		if(!empty($newAddr['workplace'])){
			$recvAddrPo['workplace'] = $newAddr['workplace'];
			$recvAddrPo['workplace_u'] = 1;
		}
		if(!empty($newAddr['iid'])){
			$recvAddrPo['iid'] = $newAddr['iid'];
			$recvAddrPo['iid_u'] = 1;
		}
		if(!empty($newAddr['updatetime'])){
			$recvAddrPo['updateTime'] = $newAddr['updatetime'];
			$recvAddrPo['updateTime_u'] = 1;
		}
		if(!empty($newAddr['createtime'])){
			$recvAddrPo['createTime'] = $newAddr['createtime'];
			$recvAddrPo['createTime_u'] = 1;
		}
		if(!empty($newAddr['default_shipping'])){
			$recvAddrPo['defaultShipping'] = $newAddr['default_shipping'];
			$recvAdrrPo['defaultShipping_u'] = 1;
		}
		if(!empty($newAddr['default_pay_type'])){
			$recvAddrPo['defaultPayType'] = $newAddr['default_pay_type'];
			$recvAddrPo['defaultPayType_u'] = 1;
		}
		if(!empty($newAddr['last_use_time'])){
			$recvAddrPo['lastUseTime'] = $newAddr['last_use_time'];
			$recvAddrPo['lastUseTime_u'] = 1;
		}
	
		return $recvAddrPo;
	}
	
	/**
	 * 
	 * @param ao返回 $data
	 */
	private static function recvAddrPoToArray($data)
	{
		$ret = array();
		$poList = $data['icsonRecvAddrPoList']['icsonRecvAddrPoList'];
		foreach($poList as $po){
			$ret[] = array(
					'aid' => $po['icsonAid'],
					'uid' => $po['icsonUid'],
					'name' => $po['name'],
					'mobile' => $po['mobile'],
					'phone' => $po['phone'],
					'district' => $po['districtIdMap'][AREA_ID_ICSON],
					'address' => $po['address'],
					'sortfactor' => $po['sortfactor'],
					'fax' => $po['fax'],
					'zipcode' => $po['zipCode'],
					'workplace' => $po['workplace'],
					'iid' => $po['iid'],
					'updatetime' => $po['updateTime'],
					'createtime' => $po['createTime'],
					'default_shipping' => $po['defaultShipping'],
					'default_pay_type' => $po['defaultPayType'],
					'last_use_time' => $po['lastUseTime'],
					'status' => 0
			);
		}
		
		return $ret;
	}
	
	/**
	 * @static
	 * @return bool|int
	 */
	private static function getAddressId()
	{
		//获取一个新id
		$newId = IIdGenerator::getNewId('useraddress');
		if (false === $newId || $newId <= 0) {
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return false;
		}
		return $newId;
	}

	/**
	 * @static 根据类型检查地址所必须的字段，以及长度限制
	 * @param $newAddress 地址内容
	 * @return bool
	 */
	private static function checkField($uid, $newAddr)
	{

		// 必须的字段
		if (!isset($newAddr['name']) || '' == $newAddr['name']) {
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'receiver name is null';
			return false;
		}

		if (strlen($newAddr['name']) > MAX_ADDR_NAME_LEN) {
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . 'receiver name len is invalid';
			return false;
		}

		if (empty($newAddr['mobile']) && empty($newAddr['phone'])) {
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[mobile is null]';
			return false;
		}

		if (!empty($newAddr['mobile']) && !ToolUtil::checkMobilePhone($newAddr['mobile'])) {
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[mobile(" . $newAddr['mobile'] . ") is invalid]";
			return false;
		}

		if (!isset($newAddr['district']) || $newAddr['district'] <= 0) {
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[district is invalid]';
			return false;
		}

		if (!isset($newAddr['address']) || "" == $newAddr['address']) {
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[address is null]';
			return false;
		}

		if (strlen($newAddr['address']) > MAX_ADDR_LEN) {
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[address len is invalid]';
			return false;
		}

		// 非必须字段
		if (!isset($newAddr['sortfactor'])) {
			$newAddr['sortfactor'] = 0;
		}

		if (!isset($newAddr['fax'])) {
			$newAddr['fax'] = "";
		}

		if (!isset($newAddr['zipcode'])) {
			$newAddr['zipcode'] = "";
		} else if (strlen($newAddr['zipcode']) > MAX_ZIPCODE_LEN) {
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[zipcode len is invalid]';
			return false;
		}

		if (!isset($newAddr['workplace'])) {
			$newAddr['workplace'] = '';
		} else if (strlen($newAddr['workplace']) > MAX_COMPANY_LEN) {
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . '[workplace len is invalid]';
			return false;
		}

		if (!isset($newAddr['iid']) || $newAddr['iid'] <= 0) {
			$newAddr['iid'] = 0;
		} else {
			//检查发票id对应的纪录是否属于该用户
			$item = EA_Invoice::get($uid, array('iid'=> $newAddr['iid']));
			if (false === $item) {
				self::$errCode = EA_Invoice::$errCode;
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[get user invoice(" . $newAddr['iid'] . ") from IUserInvoiceBookTTC failed:" . EA_Invoice::$errMsg . "]";
				return false;
			}
			if (1 != count($item)) {
				self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[invoice(" . $newAddr['iid'] . ") not exist or not belong to $uid";
				return false;
			}
		}


		return true;
	}

	/**
	 * 检查地址内容字段是否有不允许出现的字符
	 * @param string $text
	 * @return boolean 合法则为true / 不法则为则为false
	 */
	private static function checkIsValidAddressString($text)
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

	/**
	 * 检查是否合法的地址数据
	 * @param array $data
	 * @param array $numberFields
	 * @param array $stringFields
	 * @param array $phoneFields
	 * @return boolean 合法则为true / 不法则为则为false
	 */
	private static function checkIsValidAddressData($data, $blockNotChecked = false)
	{
		$ret = ToolUtil::checkAddress($data['address']);
		return true;
	}
}

?>
