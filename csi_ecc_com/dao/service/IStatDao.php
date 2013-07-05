<?php
/**
 * IStatDao.php
 *
 * 服务中心流水
 */

require_once LIB_PATH . 'Config.php';
require_once LIB_PATH . 'DB.php';

class IStatDao
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
	 * 		
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
		$db = Config::getDB('b2b2c_kf_stat');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}

		$v = $db->insert('base_stat', $data);
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
	 * 		
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
		$db = Config::getDB('b2b2c_kf_stat');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		
		$v = $db->insertOrUpdate('base_stat', $data, $updateData);
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
	 * 		
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
		$db = Config::getDB('b2b2c_kf_stat');
		
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		
		$v = $db->update('base_stat', $data, $where);
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
		$db = Config::getDB('b2b2c_kf_stat');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$v = $db->remove('base_stat', $where);
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
		$db = Config::getDB('b2b2c_kf_stat');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$v = $db->getRows2('base_stat', $fields, $where, $start, $length, ' create_time asc ');
		if($v === false) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
			echo self::$errMsg;
			return false;
		}
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
		$db = Config::getDB('b2b2c_kf_stat');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$v = $db->getRowsCount('base_stat', $where);
		if($v === false) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
			return false;
		}
		return $v;
	}
	
	//获取当日最新冗余数据
	
	public static function findLiveData($d = null) {
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_stat');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		
		$sql = "SELECT stat_key, stat_value FROM  live_stat where stat_date = '" . (empty($d) ? date("Y-m-d") : $d) . "' ORDER BY id DESC limit 1";
		$v = $db->getRows($sql);
		return $v[0];
	}
	//获取当日最新冗余数据
	
	public static function findLiveData2($d, $k) {
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_stat');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		
		$sql = "SELECT stat_value FROM  live_stat where stat_date = '" .  $d . "' and  stat_key <= '" .  $k . "' ORDER BY id DESC limit 1";
		$v = $db->getRows($sql);
		if (!empty($v)) {
			return $v[0]['stat_value'];
		} else {
			return false;
		}
	}
	//获取不满意分布情况
	
	public static function findApproveData($d = null) {
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_stat');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		
		$sql = "SELECT stat_key,stat_value FROM  daily_stat where (stat_type=2 or stat_type =3) and stat_date = '" . (empty($d) ? date("Y-m-d", (time() - 24 * 3600)) : $d) . "' ";
		$v = $db->getRows($sql);
		return $v;
	}
	
	//获取不满意百分率
	
	public static function findApprovePrecent($d = null) {
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_stat');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		
		$sql = "SELECT stat_value FROM daily_stat where stat_type=2  and stat_key='unapprove_precent' and stat_date = '" . (empty($d) ? date("Y-m-d", (time() - 24 * 3600)) : $d) . "' ";
		$v = $db->getRows($sql);
		if (!empty($v)) {
			return $v[0]['stat_value'];
		} else {
			return 1;
		}
	}

	//获取每日统计数据
	public static function findDailyData($d) {
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_stat');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		
		$sql = "SELECT stat_date, stat_value FROM daily_stat where stat_type=3 and stat_date >= '" . $d . "' ";
		$v = $db->getRows($sql);
		return $v;
	}
	
	//获取每日统计数据
	public static function findWorkloadAvgData($d) {
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_stat');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		
		$sql = "SELECT stat_date, stat_value FROM daily_stat where stat_type=5 and stat_key='average' and stat_date >= '" . $d . "' ";
		//print $sql;
		$v = $db->getRows($sql);
		return $v;
	}
	
	//获取每日统计数据
	public static function findWorkloadData($d, $limit = false) {
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_stat');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		
		$sql = "SELECT stat_key, stat_value FROM daily_stat where stat_type=5 and stat_key!='average' and stat_date = '" . $d . "' order by stat_value desc ";
		//print $sql;
		if ($limit) {
			$sql .= " limit 10";
		}
		$v = $db->getRows($sql);
		return $v;
	}
	
	//获取每日统计数据
	public static function findArchiveData($d, $type = 4) {
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_stat');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		
		$sql = "SELECT stat_key, stat_value FROM daily_stat where  stat_type=" . $type . " and stat_date = '" . $d . "' order by stat_value desc limit 10";
		$v = $db->getRows($sql);
		return $v;
	}
	
	//获取完成情况数据
	public static function findStateData($d) {
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_stat');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		
		$sql = "SELECT stat_key, stat_value FROM daily_stat where stat_type=7 and stat_date = '" . $d . "'";
		
		$v = $db->getRows($sql);
		return $v;
	}
	
	public static function findTypeData($d) {
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_stat');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$sql = "SELECT stat_type, stat_key, stat_value FROM daily_stat where stat_type in(10, 11, 12) and stat_date = '" . $d . "'";
		
		$v = $db->getRows($sql);
		return $v;
	}
	
	public static function findExpireData($d) {
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_stat');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$sql = "SELECT stat_key, stat_value FROM daily_stat where stat_type=13 and stat_date = '" . $d . "'";
		
		$v = $db->getRows($sql);
		return $v;
	}
	
	//获得某日的平均处理时长
	public static function getAvgDealtime($d) {
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_stat');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$sql = "SELECT stat_value FROM daily_stat where stat_type=14 and stat_date = '" . $d . "'";
		
		$v = $db->getRows($sql);
		return $v[0]['stat_value'];
	}
}

