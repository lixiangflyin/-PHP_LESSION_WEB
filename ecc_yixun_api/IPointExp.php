<?php
class IPointExp
{
	public static $errMsg = "";
	public static $errCode = 0;
	
	public static $PointFlowStatus = array(
		'invalid' => -1,
		'init' => 0,
		'effected' => 1,
	);
	
	public static function getUserPointExpLevel($uid)
	{
		$dbindex = $uid % ToolUtil::getMSDBNum('ICSON_ORDER_CORE');		
		$MSDB = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $dbindex);
		if (false === $MSDB) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return  false;
		}
		
		$sql = "select * from t_user_point_exp where uid=$uid";
        $pointInfo = $MSDB->getRows($sql);
        if (false === $pointInfo || count($pointInfo) <= 0) {     	
        	self::$errCode = $MSDB->$errCode;
			self::$errMsg = $MSDB->$errMsg;
			return  false;
        }
        
        $pointInfo = $pointInfo[0];
        global $_UserLevel;
	    foreach ($_UserLevel as $k=>$u)
	    {
	     	if ($pointInfo['exp_value'] >= $u['startV'] && $pointInfo['exp_value'] <= $u['endV']) {
	     		$pointInfo['level'] = $k;
	      		break;
	       	}
	    }
	    return $pointInfo;
	}
	
	/*�����û�����
	�ڲ��Ὺ�����ݿ����ӣ�����������
	*/
	public  static function opPoint( $uid, $type, $point, $valid_time_from, $valid_time_to, $paramlist, $comment)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -90;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[uid is invalid]';
			return false;
		}

		if (!isset($type)) {
			self::$errCode = -91;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[type is null]';
			return false;
		}
		
		if (!isset($valid_time_from) || $valid_time_from <= 0) {
			self::$errCode = -92;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[valid_time_from is invalid]';
			return false;
		}
		
		if (!isset($valid_time_to) || $valid_time_to < $valid_time_from) {
			$valid_time_to = $valid_time_from;
		}

		//��ȡ��ˮid
		$flow_id = IIdGenerator::getNewId('customer_pointlog_sequence');
		if (false == $flow_id || $flow_id <= 0)
		{
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return  false;
		}
		
		$now = time();
		$dbindex = $uid % ToolUtil::getMSDBNum('ICSON_ORDER_CORE');		
		$MSDB = ToolUtil::getMSDBObj('ICSON_ORDER_CORE', $dbindex);
		if (false === $MSDB) {
			self::$errCode = Config::$errCode;
			self::$errMsg = Config::$errMsg;
			return  false;
		}	
		
		$sql = "begin transaction";	
        $ret = $MSDB->execSql($sql);
        if (false === $ret) {
        	self::$errCode = $MSDB->$errCode;
			self::$errMsg = $MSDB->$errMsg;
			return  false;
        }
        
        $status = self::$PointFlowStatus['init'];
         if ($valid_time_from <= $now) {  //��ʱ��Ч
			 $status = self::$PointFlowStatus['effected'];
			 if ($point < 0) {
			 	$sql = "update t_user_point_exp set total_point = total_point + ($point), valid_point = valid_point + ($point) where uid=$uid and valid_point >= $point" ;
			 }else 
			 {
        	 	$sql = "update t_user_point_exp set total_point = total_point + ($point), valid_point = valid_point + ($point) where uid=$uid";
			 }
        }else //�������ű��ܣ�ʹ����Ч
        {
        	if ($point < 0) {
        		$sql = "update t_user_point_exp set total_point = total_point + ($point) where uid=$uid and total_point >= $point";
        	}else 
        	{
        	 	$sql = "update t_user_point_exp set total_point = total_point + ($point) where uid=$uid";
        	}
        }
        $ret = $MSDB->execSql($sql);
        if (false === $ret || 1 != $MSDB->getAffectedRows()) {
        	$sql = "roll back";
        	$MSDB->execSql($sql);
        	
        	self::$errCode = $MSDB->$errCode;
			self::$errMsg = $MSDB->$errMsg;
			return  false;
        }
        
        //��ȡtotal_pointֵ
        $sql = "select total_point from t_user_point_exp where uid=$uid";
        $pointInfo = $MSDB->getRows($sql);
        if (false === $pointInfo || count($pointInfo) <= 0) {
        	$sql = "roll back";
        	$MSDB->execSql($sql);
        	
        	self::$errCode = $MSDB->$errCode;
			self::$errMsg = $MSDB->$errMsg;
			return  false;
        }
        
        $newTotalPoint = $pointInfo[0]['total_point'];      
        $newFlow = array(
        	'flow_id' => $flow_id,
        	'uid'  => $uid,
        	'create_time' => $now,
        	'valid_time_from' => $valid_time_from,
        	'valid_time_to'  => $valid_time_to,
        	'type' => $type,
        	'point' => $point,
        	'total_point' => $newTotalPoint,
        	'status' => $status,
        	'paramlist' => $paramlist,
        	'comment' => $comment
        ); 
        
        //�ȳ��Բ���TTC������ɹ����򲻲�����ˮ��sql server�У�ֱ���ύ����
        $ret = IPointFlowTTC::insert($newFlow);
        if (true == $ret) {   //����TTC�ɹ���
        	$sql = "commit";
        	$MSDB->execSql($sql);
        	return true;
        }
        
        //�������TTCʧ�ܣ�����ˮ����sql server���ύ������ɣ��ȴ��ű���ת�ƻ�����ˮ        
        $ret = $MSDB->insert('t_point_flow', $newFlow);
        if (false === $ret) {
        	$sql = "roll back";
        	$MSDB->execSql($sql);
        	
        	self::$errCode = $MSDB->$errCode;
			self::$errMsg = $MSDB->$errMsg;
			return  false;
        }
		
        $sql = 'commit';
        $ret = $MSDB->execSql($sql);
        if (false === $ret) {
        	$sql = "roll back";
        	$MSDB->execSql($sql);
        	
        	self::$errCode = $MSDB->$errCode;
			self::$errMsg = $MSDB->$errMsg;
			return  false;
        }       
		return true;
	}
	
	/*�����û�����
	�ú����ʺ����ⲿ�Ѿ��������񣬣������ڲ����������񣩣������ⲿ�����ύ���ύ���ع����ع�
	���磺�µ�����
	����ֵ��
		�ɹ����»�����ˮ����
		ʧ�ܣ�false
	*/
	public  static function opPointInTransaction($MSDB, $uid, $type, $point, $valid_time_from, $valid_time_to, $paramlist, $comment)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -90;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[uid is invalid]';
			return false;
		}

		if (!isset($type)) {
			self::$errCode = -91;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[type is null]';
			return false;
		}
		
		if (!isset($valid_time_from) || $valid_time_from <= 0) {
			self::$errCode = -92;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[valid_time_from is invalid]';
			return false;
		}
		
		if (!isset($valid_time_to) || $valid_time_to < $valid_time_from) {
			$valid_time_to = $valid_time_from;
		}

		//��ȡ��ˮid
		$flow_id = IIdGenerator::getNewId('customer_pointlog_sequence');
		if (false == $flow_id || $flow_id <= 0)
		{
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return  false;
		}		
		
		$now = time();
        $status = self::$PointFlowStatus['init'];
        if ($valid_time_from <= $now) {  //��ʱ��Ч
			 $status = self::$PointFlowStatus['effected'];
			 if ($point < 0) {
			 	$sql = "update t_user_point_exp set total_point = total_point + ($point), valid_point = valid_point + ($point) where uid=$uid and valid_point >= $point" ;
			 }else 
			 {
        	 	$sql = "update t_user_point_exp set total_point = total_point + ($point), valid_point = valid_point + ($point) where uid=$uid";
			 }
        }else //�������ű��ܣ�ʹ����Ч
        {
        	if ($point < 0) {
        		$sql = "update t_user_point_exp set total_point = total_point + ($point) where uid=$uid and total_point >= $point";
        	}else 
        	{
        	 	$sql = "update t_user_point_exp set total_point = total_point + ($point) where uid=$uid";
        	}
        }
        $ret = $MSDB->execSql($sql);
        if (false === $ret || 1 != $MSDB->getAffectedRows()) {    	
        	self::$errCode = $MSDB->$errCode;
			self::$errMsg = $MSDB->$errMsg;
			return  false;
        }
        
        //��ȡtotal_pointֵ
        $sql = "select total_point from t_user_point_exp where uid=$uid";
        $pointInfo = $MSDB->getRows($sql);
        if (false === $pointInfo || count($pointInfo) <= 0) {
        	self::$errCode = $MSDB->$errCode;
			self::$errMsg = $MSDB->$errMsg;
			return  false;
        }        
        $newTotalPoint = $pointInfo[0]['total_point'];      
        $newFlow = array(
        	'flow_id' => $flow_id,
        	'uid'  => $uid,
        	'create_time' => $now,
        	'valid_time_from' => $valid_time_from,
        	'valid_time_to'  => $valid_time_to,
        	'type' => $type,
        	'point' => $point,
        	'total_point' => $newTotalPoint,
        	'status' => $status,
        	'paramlist' => $paramlist,
        	'comment' => $comment
        );         
        $ret = $MSDB->insert('t_point_flow', $newFlow);
        if (false === $ret) {        	
        	self::$errCode = $MSDB->$errCode;
			self::$errMsg = $MSDB->$errMsg;
			return  false;
        }    
		return $newFlow;
	}
	/*
	�µ���ɣ������ύ�ɹ��󣬽�������ˮת�Ƶ�TTC��
	*/
	public static function movePointFlowToTTC($MSDB, $newFlowArr)
	{
		$ret = IPointFlowTTC::insert($newFlowArr);
		if (false === $ret) {
			self::$errCode = IPointFlowTTC::$errCode;
			self::$errMsg = IPointFlowTTC::$errMsg;
			return false;
		}
		
		$sql = "delete from t_point_flow where uid={$newFlowArr['uid']} and flow_id={$newFlowArr['flow_id']}";
		$ret = $MSDB->execSql($sql);
		if (false === $ret) {
			self::$errCode = $MSDB->$errCode;
			self::$errMsg = $MSDB->$errMsg;
			return  false;
		}
		return true;
	}

	/*
	��ȡ$uid �Ĵ�$start��ʼ��$num����ˮ
	*/
	public  static function getPointFlow( $uid, $start, $num )
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -98;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[uid is invalid]';
			return false;
		}

		if(!isset($start))  $start = 0;
		if(!isset($num))    $num = 10;
		$result = IPointFlowTTC::get( $uid, array(), array(), $num, $start );
		if (false === $result) {
			self::$errCode = IPointFlowTTC::$errCode;
			self::$errMsg = IPointFlowTTC::$errMsg;
			return false;
		}
		return $result;
	}
	/*
	��ȡ$uid ����������
	*/
	public  static function getPointNum($uid)
	{
		if (!isset($uid) || $uid <= 0) {
			self::$errCode = -99;
			self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[uid is invalid]';
			return false;
		}
		$result = IPointFlowTTC::get($uid);
		if (false === $result) {
			self::$errCode = IPointFlowTTC::$errCode;
			self::$errMsg = IPointFlowTTC::$errMsg;
			return false;
		}
		return count($result);
	}
}
?>
