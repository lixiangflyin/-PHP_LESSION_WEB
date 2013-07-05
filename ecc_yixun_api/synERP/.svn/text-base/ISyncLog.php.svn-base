<?php
/**
 * ITSyncLogDao.php
 * 对DB:t_sync_log的增、查、删、改等操作
 * 
 * @author 
 */

class ISyncLog
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
    static function saveSyncLog($uid, $bizid,$id)
    {
        $data = array();
        //取得用户提交的数据
        if(isset($uid)) {
            $uid = intval($uid);
            if($uid > 1000000000 || $uid < 0){
                return false;
            }
            $data['uid'] = $uid;
        }
        if(isset($bizid)) {
            $bizid = intval($bizid);
            if($bizid > 1000000000 || $bizid < 0){
                return false;
            }
            $data['bizid'] = $bizid;
        }
        if(isset($id)) {
            $id = intval($id);
            if($id > 1000000000 || $id < 0){
                return false;
            }
            $data['id'] = $id;
        }
        //处理数据中的特殊字符
        $retVal = self::insert($data);
        if($retVal == false) {
            return false;
        }
        return true;
    }

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
	 * 		'uid'        =>  XXX ,
	 * 		'bizid'      =>  XXX ,
	 * 		'id'         =>  XXX ,
	 * 		'updatetime' => 'XXX',
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
		$db = Config::getDB('icson_admin');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$v = $db->insert('t_sync_log', $data);
		if(!$v) {
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
	 * 		'uid'        =>  XXX ,
	 * 		'bizid'      =>  XXX ,
	 * 		'id'         =>  XXX ,
	 * 		'updatetime' => 'XXX',
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
		$db = Config::getDB('icson_admin');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$v = $db->update('t_sync_log', $data, $where);
		if(!$v) {
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
		$db = Config::getDB('icson_admin');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$v = $db->remove('t_sync_log', $where);
		if(!$v) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
			return false;
		}
		return $v;
	}

	/**
	 * 获取指定条件的DB记录
	 * 
	 * @param string fields		需要获取的列名称
	 * @param string where		查询条件
	 * @param string start		开始记录位置
	 * @param string length		需要取得的条数量
	 * 
	 * 返回值：正确返回数据，错误返回false
	 * 数据格式:
	 * 	array(
	 * 		'uid'        =>  XXX ,
	 * 		'bizid'      =>  XXX ,
	 * 		'id'         =>  XXX ,
	 * 		'updatetime' => 'XXX',
	 * 		)
	 */
	public static function getRows($fields, $where, $start, $length)
	{
		self::clearErr();
		$db = Config::getDB('icson_admin');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$v = $db->getRows2('t_sync_log', $fields, $where, $start, $length);
		if(!$v) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
			return false;
		}
		return $v;
	}

	/**
	 * 取得指定页码的记录数
	 * 
	 * @param string fields		需要获取的列名称
	 * @param string where		查询条件
	 * @param string pageno		查询的页码
	 * @param string pagesize	每页记录大小
	 * 
	 * 返回值：正确返回数据，错误返回false
	 * 数据格式:
	 * array(
	 *  	'totalPage' => n,
	 *  	'pageSize'  => n,
	 *  	'curPageNo' => n,
	 *  	'prePageNo' => n,
	 *  	'nextPageNo'=> n,
	 *  	'itemCount' => n,
	 *  	'data' => array(...),
	 * )
	 */
	public static function getPage($fields, $where, $pageno, $pagesize)
	{
		self::clearErr();
		
		$db = Config::getDB('icson_admin');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}

		$total = $db->getRowsCount('t_sync_log', $where);
		if(!$total) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
			return false;
		}

		$pagesize	= ($pagesize < 1) ? 20 : $pagesize;
		$totalPage	= intval(ceil($total/$pagesize));
		$pageno		= min(max($pageno, 1), $totalPage);
		$start      = ($pageno -1) * $pagesize;

		$v = $db->getRows2('t_sync_log', $fields, $where, $start, $pagesize);
		if(!$v) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
			return false;
		}

		$retData = array();
		$retData['data'] = $v;
		$retData['totalPage'] = $totalPage;
		$retData['pageSize']  = $pagesize;
		$retData['curPageNo'] = $pageno;
		$retData['prePageNo'] = (($pageno > 1) ? ($pageno - 1) : 1);
		$retData['nextPageNo']= ((($pageno + 1) > $totalPage) ? $totalPage : ($pageno + 1));

		$retData['itemCount'] = intval($total);
		return $retData;
	}

	/**
	 * 获取满足条件的记录数
	 * 
	 * @param string fields		需要获取的列名称
	 * @param string where		查询条件
	 * 
	 * 返回值：正确返回数据，错误返回false
	 */
	public static function getTotalCount($fields, $where)
	{
		self::clearErr();
		$db = Config::getDB('icson_admin');
		if(!$db) {
			self::$errCode = Config::$errCode;
			self::$errMsg  = Config::$errMsg;
			return false;
		}
		$v = $db->getRowsCount('t_sync_log', $where);
		if(!$v) {
			self::$errCode = $db->errCode;
			self::$errMsg  = $db->errMsg;
			return false;
		}
		return $v;
	}

}

//End Of Script

