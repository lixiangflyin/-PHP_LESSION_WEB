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
	
	/*增加用户积分
	内部会开启数据库连接，并启动事务
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

		//获取流水id
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
         if ($valid_time_from <= $now) {  //及时生效
			 $status = self::$PointFlowStatus['effected'];
			 if ($point < 0) {
			 	$sql = "update t_user_point_exp set total_point = total_point + ($point), valid_point = valid_point + ($point) where uid=$uid and valid_point >= $point" ;
			 }else 
			 {
        	 	$sql = "update t_user_point_exp set total_point = total_point + ($point), valid_point = valid_point + ($point) where uid=$uid";
			 }
        }else //后续靠脚本跑，使其生效
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
        
        //读取total_point值
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
        
        //先尝试插入TTC，如果成功，则不插入流水到sql server中，直接提交事务
        $ret = IPointFlowTTC::insert($newFlow);
        if (true == $ret) {   //插入TTC成功，
        	$sql = "commit";
        	$MSDB->execSql($sql);
        	return true;
        }
        
        //如果插入TTC失败，则将流水插入sql server，提交事务完成，等待脚本来转移积分流水        
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
	
	/*操作用户积分
	该函数适合于外部已经开启事务，（函数内部不开启事务），跟随外部事务提交而提交，回滚而回滚
	例如：下单场景
	返回值：
		成功：新积分流水数组
		失败：false
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

		//获取流水id
		$flow_id = IIdGenerator::getNewId('customer_pointlog_sequence');
		if (false == $flow_id || $flow_id <= 0)
		{
			self::$errCode = IIdGenerator::$errCode;
			self::$errMsg = IIdGenerator::$errMsg;
			return  false;
		}		
		
		$now = time();
        $status = self::$PointFlowStatus['init'];
        if ($valid_time_from <= $now) {  //及时生效
			 $status = self::$PointFlowStatus['effected'];
			 if ($point < 0) {
			 	$sql = "update t_user_point_exp set total_point = total_point + ($point), valid_point = valid_point + ($point) where uid=$uid and valid_point >= $point" ;
			 }else 
			 {
        	 	$sql = "update t_user_point_exp set total_point = total_point + ($point), valid_point = valid_point + ($point) where uid=$uid";
			 }
        }else //后续靠脚本跑，使其生效
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
        
        //读取total_point值
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
	下单完成，事务提交成功后，讲积分流水转移到TTC中
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
	获取$uid 的从$start开始的$num条流水
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
	获取$uid 的数据条数
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
