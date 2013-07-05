<?php
//require_once('MSSQL.php');
//require_once(PHPLIB_ROOT . 'api/inc/IEventDetailTTC.php');
////require_once(PHPLIB_ROOT . 'api/inc/IEventStatistcs.php');
//require_once(PHPLIB_ROOT . 'lib/Config.php');

class IEvent
{
	public static $errCode = 0;
	public static $errMsg = '';

	/**
	 * 参加活动的用户数，
	 *
	 * @param	$bzid 活动标识
	 * @param	$batch_id 批次标识
	 *
	 */
	public static function getUserCount($bzid, $batch_id = null){

		$mysqlDb = Config::getDB('icson_other_ttc');

		if(false == $mysqlDb){

			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;

			return false;
		}


		$sql = "select ticket_count from t_event_statistcs where bzid = $bzid" . ( null === $batch_id ? '' : " and batch_id=$batch_id" );

		$info = $mysqlDb->getRows($sql);

		if(false === $info){
			self::$errCode = $mysqlDb->errCode;
			self::$errMsg = $mysqlDb->errMsg;
			return false;
		}


		$result = 0;

		foreach($info as $item){
			$result+= intval($item['ticket_count']);
		}

		return $result;
	}

	/**
	 * 获取用户参加活动的信息
	 *
	 * @param	$uid 用户ID
	 * @param	$bzid 活动标识
	 * @param	$batch_id 批次标识
	 *
	 */

	public static function getUserEventInfo($uid, $bzid, $batch_id = null){
		$uid = intval( $uid );
		$bzid = intval($bzid);

		$filter = array("bzid" => $bzid);

		if( null!== $batch_id){
			$filter["batch_id"] = intval($batch_id);
		}

		$info = IEventDetailTTC::get($uid, $filter );

		if(false === $info){
			self::$errCode = IEventDetailTTC::$errCode;
			self::$errMsg = IEventDetailTTC::$errMsg;

			return false;
		}

		return $info;

	}


	/**
	 * 提交活动请求
	 *
	 * @param	$uid 用户ID
	 * @param	$bzid 活动标识
	 * @param	$batch_id 批次标识
	 * @param	$create_time 加入时间
	 * @param	$content 活动信息
	 *
	 */

	public static function submit($uid, $bzid, $create_time, $content = '', $batch_id = 0){

		$uid = intval($uid);
		$bzid = intval($bzid);
		$batch_id = intval($batch_id);

		$mysqlDb = Config::getDB('icson_other_ttc');

		if(false == $mysqlDb){

			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;

			return false;
		}

		$sql = "start transaction";
		$ret = $mysqlDb->execSql($sql);
		if (false === $ret) {
			self::$errCode = -2032;
			self::$errMsg='开启mysql事务失败';
			return  false;
		}
		$sql = "update t_event_statistcs set ticket_count = ticket_count + 1 where bzid = $bzid and batch_id = $batch_id ";
		$ret = $mysqlDb->execSql($sql);

		if( false == $ret ){
			self::$errCode = $mysqlDb->errCode;
			self::$errMsg= $mysqlDb->errMsg;
			$sql = "rollback";
			$mysqlDb->execSql($sql);

			return false;
		}
		if( 0 === $mysqlDb->getAffectedRows()){

			$sql = "insert into t_event_statistcs (bzid, batch_id, ticket_count) values($bzid, $batch_id, 1)";
			$ret = $mysqlDb->execSql($sql);

			if( false === $ret ){
				self::$errCode = $mysqlDb->errCode;
				self::$errMsg= $mysqlDb->errMsg;
				$sql = "rollback";
				$mysqlDb->execSql($sql);

				return false;
			}

		}

		$sql = "select ticket_count from  t_event_statistcs where bzid = $bzid and batch_id = $batch_id";

		$ret = $mysqlDb->getRows($sql);

		if( false === $ret ){
			self::$errCode = $mysqlDb->errCode;
			self::$errMsg= $mysqlDb->errMsg;
			$sql = "rollback";
			$mysqlDb->execSql($sql);

			return false;
		}

		$ticket_id = intval( $ret[0]['ticket_count'] );


		$ret = IEventDetailTTC::insert(array(
		    "uid" => $uid,
		    "bzid" => $bzid,
		    "ticket_id" => $ticket_id,
		    "batch_id" => $batch_id,
		    "create_time" => $create_time,
		    "content" => $content,
			"status" => 0
		));

		if(false === $ret){
			self::$errCode = IEventDetailTTC::$errCode;
			self::$errMsg = IEventDetailTTC::$errMsg;

			$sql = "rollback";
			$mysqlDb->execSql($sql);

			return false;
		}

		$sql = "commit";

		$mysqlDb->execSql($sql);

		return $ticket_id;
	}

	/**
	 * 返回中奖用户
	 *
	 * @param	$batch_id 批次标识,默认为null
	 *
	 */

	public static function getJackpotUsers($bzid, $batch_id){
		$bzid = intval($bzid);
		$batch_id = intval($batch_id);

		$mysqlDb = Config::getDB('icson_other_ttc');

		if(false == $mysqlDb){

			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;

			return false;
		}

		$sql = "select uid from t_event_detail where bzid = $bzid and batch_id=$batch_id and `status` = 1";

		$uids  = $mysqlDb->getRows($sql);

		if(false === $uids){
			self::$errCode = $mysqlDb->$errCode;
			self::$errMsg = $mysqlDb->$errMsg;

			return false;
		}


		return $uids;
	}


	/**
	 * 返回最新用户信息
	 *
	 * @param	$batch_id 批次标识,默认为null
	 *
	 */
	public static function getTopInformation($bzid, $limit){

		$bzid = intval($bzid);
		$limit = intval($limit);

		$mysqlDb = Config::getDB('icson_other_ttc');

		if(false == $mysqlDb){

			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;

			return false;
		}

		$sql = "select * from t_event_detail where bzid = $bzid order by create_time desc limit 0, $limit";

		$items  = $mysqlDb->getRows($sql);

		if(false === $items){
			self::$errCode = $mysqlDb->$errCode;
			self::$errMsg = $mysqlDb->$errMsg;

			return false;
		}


		return $items;
	}

	/**
	 * 判断是否去过活动页
	 * @param $isSet true 操作是设置；false 操作是验证
	 * @return bool
	 */
	public static function checkEventSn($eventId, $isSet = false) {
		$key = '12@*76Rwlll';

		$ts = isset($_COOKIE['event_icson_ts' . $eventId]) ? $_COOKIE['event_icson_ts' . $eventId] : 0;
		$sn = isset($_COOKIE['event_icson_sn' . $eventId]) ? $_COOKIE['event_icson_sn' . $eventId] : 0;

		if ($isSet) { //设置
			$ts = time();
			$sn = md5($ts . md5($key . $eventId)); //event id 参与加密
			setrawcookie('event_icson_ts' . $eventId, $ts, time() + 86400, '/', '.51buy.com');
			setrawcookie('event_icson_sn' . $eventId, $sn, time() + 86400, '/', '.51buy.com');
			return true;
		}
		else { //验证
			if (empty($ts) || empty($sn)) {
				return false;
			}

			$snVfy = md5($ts . md5($key . $eventId)); //event id 参与过加密
			return $sn == $snVfy;
		}
	}

	public static function setEventVisited($eventId) {
		$vistedEvt = isset($_COOKIE['visted_eventids']) ? $_COOKIE['visted_eventids'] : '';
		if (empty($vistedEvt)) {
			setrawcookie("visted_eventids", $eventId, 60*60*24, '/', '.51buy.com');
		} else {
			setrawcookie("visted_eventids", $vistedEvt . ',' . $eventId, 60*60*24, '/', '.51buy.com');
		}
	}

	public static function getEventVisited() {
		$vistedEvt = isset($_COOKIE['visted_eventids']) ? $_COOKIE['visted_eventids'] : '';
		return $vistedEvt;
	}
}