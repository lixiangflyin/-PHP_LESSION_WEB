<?php
/**
 * IServiceApplyDao.php
 *
 * 服务中心单据
 */

require_once LIB_PATH . 'Config.php';
require_once LIB_PATH . 'DB.php';

class IServiceApplyDao
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
	 * 		'create_by'  => 'XXX ',
	 * 		'deal_id'  =>  XXX ,
	 * 		'workflow_type'  =>  XXX ,
	 * 		'workflow_detail' =>  'XXX' 
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
		$db = Config::getDB('b2b2c_kf_web');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$v = $db->insert('service_apply', $data);
		if($v === false) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
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
	 * 		'create_by'  => 'XXX ',
	 * 		'deal_id'  =>  XXX ,
	 * 		'workflow_type'  =>  XXX ,
	 * 		'workflow_detail' =>  'XXX' 
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
		$db = Config::getDB('b2b2c_kf_web');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$v = $db->insertOrUpdate('service_apply', $data, $updateData);
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
	 * 		'create_by'  => 'XXX ',
	 * 		'deal_id'  =>  XXX ,
	 * 		'workflow_type'  =>  XXX ,
	 * 		'workflow_detail' =>  'XXX' 
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
		$db = Config::getDB('b2b2c_kf_web');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$v = $db->update('service_apply', $data, $where);
		if($v === false) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
			echo self::$errMsg;
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
		$db = Config::getDB('b2b2c_kf_web');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$v = $db->remove('service_apply', $where);
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
		$db = Config::getDB('b2b2c_kf_web');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$v = $db->getRows2('service_apply', $fields, $where, $start, $length);
		if($v === false) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
		 	return false;
		}
		if(count($v) > 0){
			foreach($v as &$row){
				if(!empty($row['title'] )) {
					$row['title'] = iconv('GBK', 'UTF-8', $row['title']);
				}
				if(!empty($row['userName'] )) {
					$row['userName'] = iconv('GBK', 'UTF-8', $row['userName']);
				}
				if(!empty($row['order_state'] )) {
					$row['order_state'] = iconv('GBK', 'UTF-8', $row['order_state']);
				}
				if(!empty($row['archive'] )) {
					$row['archive'] = iconv('GBK', 'UTF-8', $row['archive']);
				}
				if(!empty($row['content'] )) {
					$row['content'] = iconv('GBK', 'UTF-8', $row['content']);
				}
				if(!empty($row['detail'] )) {
					$row['detail'] = iconv('GBK', 'UTF-8', $row['detail']);
				}
				if(!empty($row['unsati_detail'] )) {
					$row['unsati_detail'] = iconv('GBK', 'UTF-8', $row['unsati_detail']);
				}
			}
			unset($row);
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
		$db = Config::getDB('b2b2c_kf_web');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$v = $db->getRowsCount('service_apply', $where);
		if($v === false) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
			return false;
		}
		return $v;
	}
	
	/**
	 * 投诉单查询
	 */
	public static function findApplyList($where, $start = 0, $length = 10 , $fields = array(), $orderby = 'createTime DESC ', $subtype = 0) {
		global $_ORDER_CANCEL_REASON_TYPE;
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_web');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		if (empty($fields)) {
			$fields = array('id', 'orderNo', 'account', 'userPhone', 'type', 'createTime', 'state', 'content');
 		}
		if (in_array('type', $fields) && $subtype == 1) {
			$fields_str = '';
			foreach($fields as $f) {
				if ($f == 'type') {
					$fields_str .= '(case when subtype>0 then subtype else type end) as type,';
				} else {
					$fields_str .= $f . ",";
				}
			}
			$fields_str= substr($fields_str, 0 , -1);
		} else {
			$fields_str = implode(",", $fields);
		}
		$sql = "SELECT " . $fields_str . " FROM service_apply ";
		$sql .= " WHERE " . $where . " ORDER BY " . $orderby . " LIMIT " . $start . ", " . $length;
		$v = $db->getRows($sql);
		if($v === false) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
			echo self::$errMsg ;
			return false;
		}
		if(count($v) > 0){
			foreach($v as &$row){
				if(!empty($row['title'] )) {
					$row['title'] = iconv('GBK', 'UTF-8', $row['title']);
				}
				if(!empty($row['userName'] )) {
					$row['userName'] = iconv('GBK', 'UTF-8', $row['userName']);
				}
				if(!empty($row['archive'] )) {
					$row['archive'] = iconv('GBK', 'UTF-8', $row['archive']);
					$archive_array = explode(":", $row['archive']);
					$row['archive'] = $archive_array[0];
				}
				if(!empty($row['content'] )) {
					$row['content'] = iconv('GBK', 'UTF-8', $row['content']);
					if (preg_match("/^[1-8]:/", $row['content'])) {
						$k = intval(substr($row['content'], 0, 1));
						$row['content'] = $_ORDER_CANCEL_REASON_TYPE[$k] . " &nbsp;" . substr($row['content'], 2);
					}
				}
				if(!empty($row['order_state'] )) {
					$row['order_state'] = iconv('GBK', 'UTF-8', $row['order_state']);
				}
				if(!empty($row['detail'] )) {
					$row['detail'] = iconv('GBK', 'UTF-8', $row['detail']);
					$detail_array = json_decode($row['detail'], true);
					//print_r($detail_array);
					if (!empty($detail_array['postTime'])) {
						$row['content'] .= "新时间：" . urldecode($detail_array['postTime']) ;
					}
					if (!empty($detail_array['check'])) {
						$row['content'] .= "发票台头：" . urldecode($detail_array['check']) ;
					}
					if (!empty($detail_array['area'])) {
						$row['content'] .= "新地址：" . urldecode($detail_array['area']) ;
						$row['content'] .= "&nbsp;详细地址：" . urldecode($detail_array['address']) ;
						$row['content'] .= "&nbsp;收货人：" . urldecode($detail_array['consignee']) ;
						$row['content'] .= "&nbsp;收货人电话：" . urldecode($detail_array['order_mobile']) ;
					}
					if (!empty($detail_array['comment'])) {
						$row['content'] .= "&nbsp;留言：" . urldecode($detail_array['comment']) ;
					}
					
					if(!empty($detail_array['vipuser_apply_time'])) {
						$row['content'] .= "&nbsp;预约时间：" . date("Y-m-d H:i", intval(urldecode($detail_array['vipuser_apply_time']))) ;
						$row['content'] .= "&nbsp;预约人：" . urldecode($detail_array['connecter']) ;
					}
				}
				if (isset($row['detail'])) {
					unset($row['detail']);
				}
				if(!empty($row['unsati_detail'] )) {
					$row['unsati_detail'] = iconv('GBK', 'UTF-8', $row['unsati_detail']);
				}
			}
			unset($row);
		}
		return $v;
	}
	
	/**
	 * 投诉单查询
	 */
	public static function findApplyList2($where, $start = 0, $length = 10 , $fields = array(), $orderby = 'createTime DESC ', $join = array()) {
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_web');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		if (empty($fields)) {
			$fields = array('id', 'orderNo', 'account', 'userPhone', 'type', 'createTime', 'state', 'content');
 		}
		foreach($fields as &$row) {
			$row = "sa." . $row;
		}
		unset($row);
		$fields_str = implode(",", $fields);
		$sql = "SELECT " . $fields_str . " FROM service_apply sa ";
		if (!empty($join)) {
			$join_str = " JOIN " . $join['table'] . " ON " .$join['condition'];
		} else {
			$join_str = '';
		}
		$sql .= $join_str;
		$sql .= " WHERE " . $where . " ORDER BY " . $orderby . " LIMIT " . $start . ", " . $length;
		$v = $db->getRows($sql);
		if($v === false) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
			echo self::$errMsg ;
			return false;
		}
		if(count($v) > 0){
			foreach($v as &$row){
				if(!empty($row['title'] )) {
					$row['title'] = iconv('GBK', 'UTF-8', $row['title']);
				}
				if(!empty($row['userName'] )) {
					$row['userName'] = iconv('GBK', 'UTF-8', $row['userName']);
				}
				if(!empty($row['archive'] )) {
					$row['archive'] = iconv('GBK', 'UTF-8', $row['archive']);
					$archive_array = explode(":", $row['archive']);
					$row['archive'] = $archive_array[0];
				}
				if(!empty($row['content'] )) {
					$row['content'] = iconv('GBK', 'UTF-8', $row['content']);
				}
				if(!empty($row['detail'] )) {
					$row['detail'] = iconv('GBK', 'UTF-8', $row['detail']);
				}
				if(!empty($row['unsati_detail'] )) {
					$row['unsati_detail'] = iconv('GBK', 'UTF-8', $row['unsati_detail']);
				}
				if(!empty($row['order_state'] )) {
					$row['order_state'] = iconv('GBK', 'UTF-8', $row['order_state']);
				}
			}
			unset($row);
		}
		return $v;
	}

	public static function findApplyList3($where, $fields = array(), $subtype = 0, $orderby = 'createTime DESC ') {
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_web');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		if (in_array('type', $fields) && $subtype == 1) {
			$fields_str = '';
			foreach($fields as $f) {
				if ($f == 'type') {
					$fields_str .= '(case when subtype>0 then subtype else type end) as type,';
				} else {
					$fields_str .= $f . ",";
				}
			}
			$fields_str= substr($fields_str, 0 , -1);
		} else {
			$fields_str = implode(",", $fields);
		}
		$sql = "SELECT " . $fields_str . " FROM service_apply ";
		
		$sql .= $join_str;
		$sql .= " WHERE " . $where . " ORDER BY " . $orderby ;
		$v = $db->getRows($sql);
		if($v === false) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
			echo self::$errMsg ;
			return false;
		}
		if(count($v) > 0){
			foreach($v as &$row){
				if(!empty($row['title'] )) {
					$row['title'] = iconv('GBK', 'UTF-8', $row['title']);
				}
				if(!empty($row['userName'] )) {
					$row['userName'] = iconv('GBK', 'UTF-8', $row['userName']);
				}
				if(!empty($row['archive'] )) {
					$row['archive'] = iconv('GBK', 'UTF-8', $row['archive']);
					$archive_array = explode(":", $row['archive']);
					$row['archive'] = $archive_array[0];
				}
				if(!empty($row['content'] )) {
					$row['content'] = iconv('GBK', 'UTF-8', $row['content']);
				}
				if(!empty($row['detail'] )) {
					$row['detail'] = iconv('GBK', 'UTF-8', $row['detail']);
					$detail_array = json_decode($row['detail'], true);
					//print_r($detail_array);
					if (!empty($detail_array['postTime'])) {
						$row['content'] .= "新时间：" . urldecode($detail_array['postTime']) ;
					}
					if (!empty($detail_array['check'])) {
						$row['content'] .= "发票台头：" . urldecode($detail_array['check']) ;
					}
					if (!empty($detail_array['area'])) {
						$row['content'] .= "新地址：" . urldecode($detail_array['area']) ;
						$row['content'] .= "&nbsp;详细地址：" . urldecode($detail_array['address']) ;
						$row['content'] .= "&nbsp;收货人：" . urldecode($detail_array['consignee']) ;
						$row['content'] .= "&nbsp;收货人电话：" . urldecode($detail_array['order_mobile']) ;
					}
					if (!empty($detail_array['comment'])) {
						$row['content'] .= "&nbsp;留言：" . urldecode($detail_array['comment']) ;
					}
				}
				if (isset($row['detail'])) {
					unset($row['detail']);
				}
				if(!empty($row['unsati_detail'] )) {
					$row['unsati_detail'] = iconv('GBK', 'UTF-8', $row['unsati_detail']);
				}
				if(!empty($row['order_state'] )) {
					$row['order_state'] = iconv('GBK', 'UTF-8', $row['order_state']);
				}
			}
			unset($row);
		}
		return $v;
	}
	
	//统计各种数量
	public static function getCount2($where) {
		self::clearErr();
		$db = Config::getDB('b2b2c_kf_web');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$sql = "SELECT COUNT(*) AS total, followKF FROM service_apply WHERE " . $where . " GROUP BY followKF";
	 	$v = $db->getRows($sql);
		if($v === false) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
			return false;
		}
		return $v;
	}
}

