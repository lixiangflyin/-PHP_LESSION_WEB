<?php
/**
 * ITSyncLogDao.php
 * ��DB:t_sync_log�������顢ɾ���ĵȲ���
 * 
 * @author 
 */

class ISyncLog
{
	/**
	 * �������
	 */
	public static $errCode = 0;

	/**
	 * ������Ϣ
	 */
	public static $errMsg  = '';

	/**
	 * ��������ʶ����ÿ����������ǰ����
	 */
    static function saveSyncLog($uid, $bizid,$id)
    {
        $data = array();
        //ȡ���û��ύ������
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
        //���������е������ַ�
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
	 * ����һ��DB��¼
	 * 
	 * @param	data	��ʽ: 
	 * 	array(
	 * 		'uid'        =>  XXX ,
	 * 		'bizid'      =>  XXX ,
	 * 		'id'         =>  XXX ,
	 * 		'updatetime' => 'XXX',
	 * 		)
	 * 
	 * ����ֵ����ȷ����true�����󷵻�false
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
	 * ����һ��DB��¼
	 * 
	 * @param	data	��ʽ: 
	 * 	array(
	 * 		'uid'        =>  XXX ,
	 * 		'bizid'      =>  XXX ,
	 * 		'id'         =>  XXX ,
	 * 		'updatetime' => 'XXX',
	 * 		)
	 * @param string where	���ݿ��ѯ��������ʽ��v=1 and v1=2
	 * 
	 * ����ֵ����ȷ����true�����󷵻�false
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
	 * ɾ��һ��DB��¼
	 * 
	 * @param string where	���ݿ��ѯ��������ʽ��v=1 and v1=2
	 * 
	 * ����ֵ����ȷ����true�����󷵻�false
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
	 * ��ȡָ��������DB��¼
	 * 
	 * @param string fields		��Ҫ��ȡ��������
	 * @param string where		��ѯ����
	 * @param string start		��ʼ��¼λ��
	 * @param string length		��Ҫȡ�õ�������
	 * 
	 * ����ֵ����ȷ�������ݣ����󷵻�false
	 * ���ݸ�ʽ:
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
	 * ȡ��ָ��ҳ��ļ�¼��
	 * 
	 * @param string fields		��Ҫ��ȡ��������
	 * @param string where		��ѯ����
	 * @param string pageno		��ѯ��ҳ��
	 * @param string pagesize	ÿҳ��¼��С
	 * 
	 * ����ֵ����ȷ�������ݣ����󷵻�false
	 * ���ݸ�ʽ:
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
	 * ��ȡ���������ļ�¼��
	 * 
	 * @param string fields		��Ҫ��ȡ��������
	 * @param string where		��ѯ����
	 * 
	 * ����ֵ����ȷ�������ݣ����󷵻�false
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

