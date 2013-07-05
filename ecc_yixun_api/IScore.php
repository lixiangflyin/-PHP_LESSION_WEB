<?php
require_once(PHPLIB_ROOT . 'api/appplatform/platform/web_stub_cntl.php');
require_once(PHPLIB_ROOT . 'api/appplatform/platform/lang_util.php');
require_once(PHPLIB_ROOT . 'api/appplatform/pointsaccountao_stub4php.php');
define('ACCESSBUSSINESSID', 10001);
define('OPERATEVERIFYCODE', '5ab711ef3070eb9140e8d6ae96134a9b');

class IScore
{
    public static $errMsg = "";
    public static $errCode = 0;
    //调用网购侧接口
    public static $gCntl = false;
    
    public static function _initCntl($uid)
    {
        $g_cntl = new WebStubCntl();
        $sPassport = "0123456789";
        $g_cntl->setDwOperatorId($uid);
        $g_cntl->setSPassport($sPassport);
        $g_cntl->setDwSerialNo(10002);
        $g_cntl->setDwUin($uid);
        $g_cntl->setWVersion(2);
		/*
		$ip = Config::getIP('USER_WG_AO');
		if (NULL == $ip) {
			self::$errCode = 110;
			self::$errMsg = basename(__FILE__, '.php') . " | Line:" . __LINE__ . "[getip failed ($ip : session_{$index} : time {$time_} : cmd {$cmd_})]";
			return false;
		}
		$rand_keys = array_rand($ip,1);
		$ip = $ip[$rand_keys];
		
		$g_cntl->setPeerIPPort($ip["IP"], $ip["PORT"]);
		*/
		$g_cntl->setCallerName("SCORE");
        self::$gCntl = $g_cntl;

        return;
    }

    /*
    *增加一条流水
    */
    public  static function addScoreFlow( $flow_id, $uid, $type, $score, $cash_point, $promotion_point, $total_score, $paramlist, $comment )
    {
        if (!isset($flow_id)) {
        	self::$errCode = 100;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[flow_id is null]';
            return false;
        }

        if (!isset($uid) || $uid <= 0 ) {
        	self::$errCode = 101;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[uid is invalid]';
            return false;
        }

        if (!isset($type)) {
        	self::$errCode = 102;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[type is null]';
            return false;
        }

        $score_time = time();
        $ret = IScoreFlowTTC::insert(array('uid'=>$uid, 'flow_id'=>$flow_id, 'score_time'=> $score_time, 'type'=>$type,'score'=>$score,'cash_point'=>$cash_point, 'promotion_point' => $promotion_point,'total_score'=>$total_score, 'paramlist'=>$paramlist, 'comment'=>$comment, 'status'=>0));
        if (false == $ret) {
        	self::$errCode = 103;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[insert new score flow into scoreflowTTC failed]' . IScoreFlowTTC::$errMsg;
            Logger::info(self::$errMsg);
			return false;
        }

        return true;
    }

    public  static function addScore( $uid, $type, $score, $paramlist, $comment, $cash_point, $promotion_point, $db = NULL )
    {
        if (!isset($uid) || $uid <= 0) {
        	self::$errCode = 200;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[uid is invalid]';
            return false;
        }

        if (!isset($type)) {
        	self::$errCode = 201;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[type is null]';
            return false;
        }

        //获取流水id
        $flow_id = IIdGenerator::getNewId('customer_pointlog_sequence');
        if (false == $flow_id || $flow_id <= 0)
        {
        	self::$errCode = 202;
            self::$errMsg = IIdGenerator::$errMsg;
			Logger::info("[IScore::addScore trace],Error in (IIdGenerator::getNewId),errMsg [ " . IIdGenerator::$errMsg . " ]");
            return  false;
        }

        $MSDB = $db;
       // if (NULL === $MSDB)
        {
            $MSDB = Config::getMSDB('Customer');
            if (false === $MSDB)
            {
                self::$errCode = Config::$errCode;
                self::$errMsg  = Config::$errMsg;
				Logger::info("[IScore::addScore trace],Error in (Config::getMSDB('Customer')),errMsg [ " . Config::$errMsg . " ]");
                return false;
            }
        }

        // start transaction
        $sql = "begin transaction";
        $ret = $MSDB->execSql($sql);
        if (false === $ret)
        {
            self::$errCode = $MSDB->errCode;
            self::$errMsg='开启mysql事务失败'.$MSDB->errMsg;
            return  false;
        }
        if($score < 0)  //扣减积分，需要判断用户积分是否足够扣，优先扣现金积分，未完成？？？？？
        {
            $sql = "UPDATE Customer SET
					validScore = validScore + {$score},
					CashValidScore = isnull(CashValidScore,0) + {$cash_point},
					SalesPromotionValidScore = isnull(SalesPromotionValidScore,0) + {$promotion_point}
					WHERE SysNo = {$uid} AND (validScore + ($score) >= 0)";
        }
        else
        {
            $sql = "UPDATE Customer SET
					validScore = validScore + {$score},
					CashValidScore = isnull(CashValidScore,0) + {$cash_point},
					SalesPromotionValidScore = isnull(SalesPromotionValidScore,0) + {$promotion_point},
					TotalScore = TotalScore + {$score}
					WHERE SysNo = {$uid}";
        }

        $ret = $MSDB->execSql($sql);
        if (false === $ret)
        {
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg . $sql;
            self::$errCode = $MSDB->errCode;
            $sql = "rollback";
            $MSDB->execSql($sql);

			Logger::info("[IScore::addScore trace], 执行sql语句失败 Error in (update score with customer),errMsg [ " . $MSDB->errMsg . " ], sql语句 [ " . $sql . " ]");
            return  false;
        }
        else if (1 != $MSDB->getAffectedRows())
        {
            self::$errMsg='执行sql语句无影响数据' . $sql;
            self::$errCode = 203;
            $sql = "rollback";
            $MSDB->execSql($sql);

			Logger::info("[IScore::addScore trace], 执行sql语句无影响数据 Error in (update score with customer),errMsg [ " . $MSDB->errMsg . " ], sql语句 [ " . $sql . " ]");
            return  false;
        }

        $sql = "INSERT INTO Customer_PointLog (sysNo, CustomerSysNo, PointLogType, PointAmount,
                  CreateTime, Memo, LogCheck, rowCreateDate, rowModifyDate, CashValidScore, SalesPromotionValidScore)
                VALUES ({$flow_id}, {$uid}, {$type}, {$score}, GETDATE(), '{$paramlist}', '', GETDATE(), GETDATE(),{$cash_point},{$promotion_point})";

        $ret = $MSDB->execSql($sql);
        if (false === $ret)
        {
            self::$errCode = $MSDB->errCode;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
            $sql = "rollback";
            $MSDB->execSql($sql);

			Logger::info("[IScore::addScore trace], 执行sql语句失败 Error in (insert Customer_PointLog),errMsg [ " . $MSDB->errMsg . " ], sql语句 [ " . $sql . " ]");
            return false;
        }

        $sql = "SELECT validScore, TotalScore, CashValidScore, SalesPromotionValidScore FROM Customer WHERE SysNo = {$uid}";
        $ret = $MSDB->getRows($sql);
        $data = array('uid'=>$uid);
        if (false === $ret)
        {
            self::$errCode = $MSDB->errCode;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
            $sql = "rollback";
            $MSDB->execSql($sql);

			Logger::info("[IScore::addScore trace], 执行sql语句失败 Error in (select Customer),errMsg [ " . $MSDB->errMsg . " ], sql语句 [ " . $sql . " ]");
            return  false;
        }
        else
        {
            $data['valid_point'] = $ret[0]['validScore'];
            $data['total_point'] = $ret[0]['TotalScore'];
			$data['cash_point'] = empty($ret[0]['CashValidScore']) ? 0 : $ret[0]['CashValidScore'];
            $data['promotion_point'] = empty($ret[0]['SalesPromotionValidScore']) ? 0 : $ret[0]['SalesPromotionValidScore'];
        }

        $ret = IUsersTTC::update( $data );
        if (false === $ret)
        {
            self::$errCode =IUsersTTC::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "[uid:{$uid}]" . '[update point into usersTTC failed]' . IUsersTTC::$errMsg;
            $sql = "rollback";
            $MSDB->execSql($sql);

            Logger::err("[IScore trace]update user score fail in IScore file uid[" . $data['uid'] . "], vaild point[" . $data['valid_point'] . "],
			cash point[" . $data['cash_point'] . "], promotion point [" . $data['promotion_point'] . "], total point [" . $data['total_point'] . "],
			memo [" . $paramlist . "]" . IUsersTTC::$errMsg);
            return false;
        }
        else
        {
            Logger::info("[IScore trace]update user score success in IScore file uid[" . $data['uid'] . "], vaild point[" . $data['valid_point']. "],
			cash point[" . $data['cash_point'] . "], promotion point [" . $data['promotion_point']  . "],total point [" . $data['total_point'] . "] memo [" . $paramlist . "]");
        }
        $sql = "commit";
        $MSDB->execSql($sql);

        //在积分写入成功的情况下调用网购侧接口，积分出入帐
        self::addScoreWg($flow_id, $uid, $type, $score, $paramlist, $comment, $cash_point, $promotion_point);
        //增加流水
        $ret = self::addScoreFlow( $flow_id, $uid, $type, $score, $cash_point, $promotion_point, $data['valid_point'], $paramlist, $comment );
        if (false == $ret) {
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . "[uid:{$uid}]" . '[addScoreFlow failed]' . ' ' . self::$errMsg;
            Logger::info("[IScore::addScore trace], Error in (方法addScoreFlow)");
			return true;
        }

        return true;
    }

    public static function addScoreWg($flow_id, $uid, $type, $score, $paramlist, $comment, $cash_point, $promotion_point)
    {
        Logger::info("[IScore::addScoreWg trace] enter!");
        self::_initCntl($uid);
        $g_cntl = self::$gCntl;
        if($score < 0)
        {
            //扣减积分
            $reqSps = new PointsDeductReq();
            $respSps = new PointsDeductResp();
            Logger::info("[IScore::addScoreWg trace] PointsDeductReq!");
            //积分扣减结构
            $reqSps->pointsOutPo->ddwIcsonUid = $uid;
            $reqSps->pointsOutPo->dwPoints = abs($score);
            $reqSps->pointsOutPo->dwType = $type;
            $reqSps->pointsOutPo->strRemarks = $paramlist;
            $reqSps->pointsOutPo->strReserve = $flow_id;
            $reqSps->pointsOutPo->cIcsonUid_u = 1;
            $reqSps->pointsOutPo->cPoints_u = 1;
            $reqSps->pointsOutPo->cType_u = 1;
            $reqSps->pointsOutPo->cRemarks_u = 1;
            $reqSps->pointsOutPo->cReserve_u = 1;
        }
        else
        {
            //发放积分
            $reqSps = new PointsDeliverReq();
            $respSps = new PointsDeliverResp();
            Logger::info("[IScore::addScoreWg trace] PointsDeliverReq!");
            //积分发放结构
            $reqSps->pointsInPo->ddwIcsonUid = $uid;
            $reqSps->pointsInPo->dwType = $type;
            $reqSps->pointsInPo->dwPromotionPoints = $promotion_point;
            $reqSps->pointsInPo->dwCashPoints = $cash_point;
            $reqSps->pointsInPo->dwAddtime = time();
            $reqSps->pointsInPo->strRemarks = $paramlist;
            $reqSps->pointsInPo->strReserve = $flow_id;
            $reqSps->pointsInPo->cIcsonUid_u = 1;
            $reqSps->pointsInPo->cType_u = 1;
            $reqSps->pointsInPo->cPromotionPoints_u = 1;
            $reqSps->pointsInPo->cCashPoints_u = 1;
            $reqSps->pointsInPo->cAddtime_u = 1;
            $reqSps->pointsInPo->cRemarks_u = 1;
            $reqSps->pointsInPo->cReserve_u = 1;
        }
        $reqSps->machineKey = ToolUtil::getClientIP();
        $reqSps->source = __FILE__;
        $reqSps->sceneId = 0;
        $reqSps->pointsVerifyPo->dwAccessBussinessID = ACCESSBUSSINESSID;       
		$reqSps->pointsVerifyPo->strOperatorName = "IScore.php";
        $reqSps->pointsVerifyPo->strOperateVerifyCode = OPERATEVERIFYCODE;
        $reqSps->pointsVerifyPo->cAccessBussinessID_u = 1;
        $reqSps->pointsVerifyPo->cOperatorName_u = 1;
        $reqSps->pointsVerifyPo->cOperateVerifyCode_u = 1;
        $reqSps->inReserve = "";
        //Logger::info("[IScore::addScoreWg trace], reqSps ==> ". print_r($reqSps, true));
        $ret = $g_cntl->invoke($reqSps, $respSps, 3);
        
        if($ret != 0 && $ret != 0xffffcc70)
        {
            self::$errCode = 401;
            self::$errMsg = $respSps->errmsg;
            Logger::err("[IScore::addScoreWg trace], Error in [" . self::$errMsg . "]uid[".$uid."]flow_id[".$flow_id."]type[".$type."]score[".$score."]cash_point[".$cash_point."]promotion_point[".$promotion_point."]");
            return false;   
        }
        Logger::info("[IScore::addScoreWg trace], success!");
        return true;        
    }
    public  static function adjustScoreByFlow($uid)
    {
        if (!isset($uid) || $uid <= 0) {
            self::$errCode = 300;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[uid is invalid]';
            return false;
        }
        // syn score to sql server
        if (false === self::synScore($uid, $type, $score, $paramlist, $flow_id))
        {
            self::$errCode = 301;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[syn to ms server fail]';
            return false;
        }

        //获取用户积分以更新流水中总分和用户总分
        $item = IUsersTTC::get($uid, array(), array('valid_point'));
        if (false == $item || count($item) <= 0)
        {
            self::$errCode = 302;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " get ($uid) from usersTTC faild.";
            return  false;
        }
        $total_score = $item[0]['valid_point'];

        //获取流水
        $stat_score = 0;
        $ret = IScoreFlowTTC::get($uid);
        if (false == $ret) {
            self::$errCode = 303;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[addScoreFlow failed]' . ' ' . self::$errMsg;
            return false;
        }
        else
        {
            foreach ($ret AS $item)
            {
                $stat_score += $item['score'];
            }
        }

        if ($stat_score != $total_score)
        {
            //更新用户个人信息中积分
            $ret = IUsersTTC::update( array('uid'=>$uid, 'valid_point'=>$total_score) );
            if (false == $ret) {
            	self::$errCode = IUsersTTC::$errCode;
                self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[update point into usersTTC failed]' . IUsersTTC::$errMsg;
                return false;
            }
        }

        return true;
    }

    /*
     * 获取$uid 的从$start开始的$num条流水
    */
    public  static function getScore( $uid, $start, $num )
    {
        if (!isset($uid) || $uid <= 0) {
            self::$errCode = 400;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[uid is invalid]';
            return false;
        }

        if(!isset($start))  $start = 0;
        if(!isset($num))    $num = 10;
    /*
        $scoreflowTTC = Config::getTTC('IScoreFlowTTC');

        if (null == $scoreflowTTC){
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get scoreflowTTC(IScoreFlowTTC) ttc failed]';
            return false;
        }
*/
        $result = IScoreFlowTTC::get( $uid, array(), array(), $num, $start );
    //    $result = $scoreflowTTC->get( $uid, array(), array(), $num, $start );
        if (false === $result) {
            self::$errCode = IScoreFlowTTC::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get score flow from scoreflowTTC failed]' . IScoreFlowTTC::$errMsg;
            return false;
        }

		//积分类型编号为999的积分流水，在我的积分中不显示
		if(count($result) > 0){
			foreach ($result as $key => $val){
				if($val['type'] == 999){
					unset($result[$key]);
				}
			}
		}

        return $result;

    }
    /*
     * 获取$uid 的数据条数
    */
    public  static function getScoreNum($uid)
    {
        if (!isset($uid) || $uid <= 0) {
            self::$errCode = 500;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[uid is invalid]';
            return false;
        }
    /*
        $scoreflowTTC = Config::getTTC('IScoreFlowTTC');
        if (null == $scoreflowTTC){
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get scoreflowTTC(IScoreFlowTTC) ttc failed]';
            return false;
        }

        $result = $scoreflowTTC->get( $uid);
   */
        $result = IScoreFlowTTC::get($uid);
        if (false === $result) {
            self::$errCode = IScoreFlowTTC::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get score flow from scoreflowTTC failed]' . IScoreFlowTTC::$errMsg;
            return false;
        }

		//积分类型编号为999的积分流水，在我的积分中不显示
		if(count($result) > 0){
			foreach ($result as $key => $val){
				if($val['type'] == 999){
					unset($result[$key]);
				}
			}
		}

        return count($result);

    }
	
	public  static function insertBackData($data)
    {
		$ret_onsbttc = IOrdersNeedScoreBackTTC::insert($data);
		if(false === $ret_onsbttc)
		{
			//如果失败，再试一次
			$ret_onsbttc = IOrdersNeedScoreBackTTC::insert($data);
			if(false === $ret_onsbttc)
			{
				self::$errCode = IOrdersNeedScoreBackTTC::$errCode;
				self::$errMsg  = IOrdersNeedScoreBackTTC::$errMsg;
				
				if(ERROR_COMMIT_ORDER == $data['type'])
				{
					//记录日志，并发送短信给相关的人员
					$mobile = '13818550317';
					$ret = IMessage::sendSMSMessage($mobile, "用户:" . $data['uid'] . "提交的订单". $data['order_id'] . "失败，但是扣了" . $data['cash_point'] . "个现金积分，" . $data['promotion_point'] . "个促销积分");
					if (false === $ret)
					{
						Logger::err("下单失败时积分未及时返还的通知短信发送失败,line:" . __LINE__ . IMessage::$errMsg);
					}
				}
				Logger::err("insert IOrdersNeedScoreBackTTC error：Line(" . __LINE__  . ") | errorCode(" . IOrdersNeedScoreBackTTC::$errCode . ") | errorMsg(" . IOrdersNeedScoreBackTTC::$errMsg . ")");
				return false;
			}
		}

		return true;
    }
	
	public  static function removeBackData($data)
    {
		$ret_remove = IOrdersNeedScoreBackTTC::remove($data['order_id']);
		if(false === $ret_remove)
		{
			//如果失败，再试一次
			$ret_remove = IOrdersNeedScoreBackTTC::remove($data['order_id']);
			if(false === $ret_remove)
			{
				//除了写日志，还要及时通知到相关人员
				self::$errCode = IOrdersNeedScoreBackTTC::$errCode;
				self::$errMsg  = IOrdersNeedScoreBackTTC::$errMsg;
				
				$mobile = '13818550317';
				$ret = IMessage::sendSMSMessage($mobile, "订单:" . $data['order_id'] . "取消commit失败时，移除返还积分表中的记录失败");
				if (false === $ret)
				{
					Logger::err("取消订单失败时移除返还基本表中记录的通知短信发送失败,line:" . __LINE__ . IMessage::$errMsg);
				}
				
				Logger::err("IOrdersNeedScoreBackTTC::remove error：Line(" . __LINE__  . ") | errorCode(" . IOrdersNeedScoreBackTTC::$errCode . ") | errorMsg(" . IOrdersNeedScoreBackTTC::$errMsg . ")");
				return false;
			}
		}
		return true;
    }
	

    private static function synScore($uid_, $type_, $score_, $paramlist_, $flow_id_)
    {
        $MSDB = Config::getMSDB('Customer');
        if (false === $MSDB)
        {
            self::$errCode = Config::$errCode;
            self::$errMsg  = Config::$errMsg;
            return false;
        }

        // start transaction
        $sql = "begin transaction";
        $ret = $MSDB->execSql($sql);
        if (false === $ret)
        {
            self::$errCode = $MSDB->errCode;
            self::$errMsg='开启mysql事务失败'.$MSDB->errMsg;
            return  false;
        }
        if($score_ < 0)  //扣减积分，需要判断用户积分是否足够扣
        {
            $sql = "UPDATE Customer SET validScore = validScore + {$score_} WHERE SysNo = {$uid_} AND (validScore + ($score_) >= 0)";
        }
        else
        {
            $sql = "UPDATE Customer SET validScore = validScore + {$score_}, TotalScore = TotalScore + {$score_} WHERE SysNo = {$uid_}";
        }

        $ret = $MSDB->execSql($sql);
        if (false === $ret || 1 != $MSDB->getAffectedRows())
        {
            self::$errCode = $MSDB->errCode;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg . $sql;
            $sql = "rollback";
            $MSDB->execSql($sql);

            return  false;
        }

        $sql = "INSERT INTO Customer_PointLog (sysNo, CustomerSysNo, PointLogType, PointAmount,
                  CreateTime, Memo, LogCheck, rowCreateDate, rowModifyDate)
                VALUES ({$flow_id_}, {$uid_}, {$type_}, {$score_}, GETDATE(), '{$paramlist_}', '', GETDATE(), GETDATE())";

        $ret = $MSDB->execSql($sql);
        if (false === $ret)
        {
            self::$errCode = $MSDB->errCode;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
            $sql = "rollback";
            $MSDB->execSql($sql);

            return  false;
        }

        $sql = "commit";
        $MSDB->execSql($sql);

        return true;
    }

}
?>
