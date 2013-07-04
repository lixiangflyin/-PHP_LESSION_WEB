<?php
/**
 * IAssignmentDao.php
 *
 * 服务中心流水
 */

require_once LIB_PATH . 'Config.php';
require_once LIB_PATH . 'DB.php';

class IAssignmentDao
{
	/**
	 * 错误编码
	 */
	public static $errCode = 0;

	/**
	 * 错误消息
	 */
	public static $errMsg  = '';

	/**
	 * 清除错误标识，在每个函数调用前调用
	 */
	private static function clearErr()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}
		
	/**
	 * 增加一条DB记录
	 *
	 * @param	data	格式:
	 * 	array(
	 * 		'create_time'  => XXX,
	 * 		'complaint_id'  =>  XXX ,
	 * 		'type'  =>  XXX ,
	 * 		'followKF' =>  'XXX' 
	 * 		)
	 *
	 * 返回值：正确返回true，错误返回false
	 */
	public static function insert($data) {
		self::clearErr();
		if(empty($data) || !is_array($data)) {
			self::$errCode = 111;
			self::$errMsg  = 'data is empty';
		}
		$db = Config::getDB('b2b2c_kf_admin');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		
		$v = $db->insert('spf_assign_overtime', $data);
		if($v === false) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
			//echo self::$errMsg;
			return false;
		}
		return $v;
	}
	
	/**
	 * 增加或者更新一条DB记录
	 *
	 * @param	data	格式:
	 * 	array(
	 * 		'id'    =>  XXX ,
	 * 		'create_time'  => XXX,
	 * 		'complaint_id'  =>  XXX ,
	 * 		'type'  =>  XXX ,
	 * 		'followKF' =>  'XXX' 
	 * 		)
	 *
	 * 返回值：正确返回true，错误返回false
	 */
	public static function insertOrUpdate($data, $updateData) {
		self::clearErr();
		if(empty($data) || !is_array($data) || empty($updateData) || !is_array($updateData)) {
			self::$errCode = 111;
			self::$errMsg  = 'data is empty';
		}
		$db = Config::getDB('b2b2c_kf_admin');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		if (!empty($data['workflow_detail'])) {
			$data['workflow_detail'] = iconv("utf8", "gbk", $data['workflow_detail']);
		}
		$v = $db->insertOrUpdate('sfp_workflows', $data, $updateData);
		if($v === false) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
			return false;
		}
		return $v;
	}
	
	/**
	 * 更新一条DB记录
	 *
	 * @param	data	格式:
	 * 	array(
	 * 		'id'    =>  XXX ,
	 * 		'create_time'  => XXX,
	 * 		'complaint_id'  =>  XXX ,
	 * 		'type'  =>  XXX ,
	 * 		'followKF' =>  'XXX' 
	 * 		)
	 * @param string where	数据库查询条件，格式：v=1 and v1=2
	 *
	 * 返回值：正确返回true，错误返回false
	 */
	public static function update($data, $where)
	{
		self::clearErr();
		if(empty($data) || !is_array($data)) {
			self::$errCode = 111;
			self::$errMsg  = 'data is empty';
		}
		$db = Config::getDB('b2b2c_kf_admin');
		
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		if (!empty($data['workflow_detail'])) {
			$data['workflow_detail'] = iconv("utf8", "gbk", $data['workflow_detail']);
		}
		$v = $db->update('spf_assign_overtime', $data, $where);
		if($v === false) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
			return false;
		}
		return $v;
	}
	
	/**
	 * 删除一条DB记录
	 *
	 * @param string where	数据库查询条件，格式：v=1 and v1=2
	 *
	 * 返回值：正确返回true，错误返回false
	 */
	public static function remove($where)
	{
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_admin');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$v = $db->remove('spf_assign_overtime', $where);
		if($v === false) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
			return false;
		}
		return $v;
	}
	/**
	 * 获取指定条件的记录
	 * 
	 * @param string fields		需要获取的列名称
	 * @param string where		查询条件
	 * @param string start		开始记录位置
	 * @param string length		需要取得的条数量
	 * 
	 * 返回数据格式:
	 * array(
	 * 0 =>	array('字段名' => '字段值'),
	 * )
	 */
	public static function getList($fields, $where, $start, $length)
	{
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_admin');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$v = $db->getRows2('spf_assign_overtime', $fields, $where, $start, $length, ' create_time DESC ');
		if($v === false) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
			return false;
		}
		unset($row);
		return $v;
	}
	/**
	 * 获取指定条件的记录总数
	 * 
	 * @param string where		查询条件
	 * 
	 */
	public static function getCount($where)
	{
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_admin');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$v = $db->getRowsCount('spf_assign_overtime', $where);
		if($v === false) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
			return false;
		}
		return $v;
	}
	
	//根据kf查找超时的工单
	public static function findByKF($kf) {
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_admin');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$sql = " select * from spf_assign_overtime where followKF='" . $kf . "'";
		$v = $db->getRows($sql);
		if($v === false) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
			return false;
		}
		return $v;
	}
}

