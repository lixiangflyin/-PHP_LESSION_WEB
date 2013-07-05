<?php
//require_once('Config.php');
require_once(PHPLIB_ROOT . 'inc/constant.inc.php');
//require_once('ToolUtil.php');
//require_once('Logger.php');
//require_once('NetUtil.php');
//require_once('inc/IIdGenerator.php');
//require_once('inc/IUsersTTC.php');
//require_once('inc/IUserReviewLimitTTC.php');

define('SPP_PROCESS_SUC',           634953);
define('SPP_PROCESS_FAILED',        634954);

define('IDGENERATOR_SUC',           634955);
define('IDGENERATOR_FAILED',        634956);

define('REVIEWFILTER_SUC',          634957);
define('REVIEWFILTER_FAILED',       634958);

define('USERTYPETTC_SUC',           634959);
define('USERTYPETTC_FAILED',        634960);

define('USERREVIEWLIMITTTC_SUC',    634961);
define('USERREVIEWLIMITTTC_FAILED', 634962);

define('SERVICE_SUC',               634963);
define('SERVICE_FAILED',            634964);

define('PRODUCTINFOTTC_SUC',        634965);
define('PRODUCTINFOTTC_FAILED',     634966);

define('USER_SUC',                  634967);
define('USER_FAILED',               634968);

define('SCORE_SUC',                 634969);
define('SCORE_FAILED',              634970);
/**
 * The basic class of review system
 * @author Bill
 *
 */

class IReview
{
    public static $errCode = 0;
    public static $errMsg = '';

    /**
     * Set the review as the top
     * @param uint $review_id_  review id
     * @param uint $user_id_    user id
     * @return success or false
     */
    public static function setTop($product_id_, $review_id_, $user_id_, $type_)
    {
       return self::setStatus($product_id_, $review_id_, $user_id_, $type_, 'TOP');
    }

    /**
     * Set the review as the best
     * @param uint $review_id_  review id
     * @param uint $user_id_    user id
     * @return success or false
     */
    public static function setBest($product_id_, $review_id_, $user_id_, $type_)
    {
       return self::setStatus($product_id_, $review_id_, $user_id_, $type_, 'BEST');
    }

    /**
     * Set the review as the top
     * @param uint $review_id_  review id
     * @param uint $user_id_    user id
     * @return success or false
     */
    public static function setUNTop($product_id_, $review_id_, $user_id_, $type_)
    {
       return self::setStatus($product_id_, $review_id_, $user_id_, $type_, 'UNTOP');
    }

    /**
     * Set the review as the best
     * @param uint $review_id_  review id
     * @param uint $user_id_    user id
     * @return success or false
     */
    public static function setUNBest($product_id_, $review_id_, $user_id_, $type_)
    {
       return self::setStatus($product_id_, $review_id_, $user_id_, $type_, 'UNBEST');
    }

    /**
     * set the review as like
     * @param uint $review_id_ review id
     * @param uint $user_id_   user id
     * @return true or false
     */
    public static function setReviewLike($product_id_, $review_id_, $user_id_, $type_, $quantity_ = 1)
    {
       return self::setStatus($product_id_, $review_id_, $user_id_, $type_, 'LIKE', $quantity_);
    }

    /**
     * set the review as unlike
     * @param uint $review_id_ review id
     * @param uint $user_id_   user id
     * @return true or false
     */
    public static function setReviewUnlike($product_id_, $review_id_, $user_id_, $type_, $quantity_ = 1)
    {
       return self::setStatus($product_id_, $review_id_, $user_id_, $type_, 'UNLIKE', $quantity_);
    }

    public static function setStatus($product_id_, $review_id_, $user_id_, $type_, $status_ = "APPROVED", $quantity_ = 0)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        global $_REVIEW_ATTRIBUTE_TYPE;
        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['UPDATE'], $_REVIEW_CATEGORY['REVIEW_ATTRIBUTE'], IReview::getSubCategoryIdByType($type_),
                    $product_id_, $review_id_, $user_id_, $quantity_, "", 0, $_REVIEW_ATTRIBUTE_TYPE[$status_], "", "", "");

        return IReview::sendRequest($cmd, true);
    }

    public static function checkUserReviewLimit($uid, $biz_id, $type)
    {
        global $_USER_REVIEW_LIMIT;
        $now = time();

        $limit = IUserReviewLimitTTC::get($uid, array('biz_id' => $biz_id, 'type' => $type));
        // any error is allow to review
        if (false === $limit)
        {
            return true;
        }
        // the user not reviewed
        else if (0 < count($limit))
        {
            $last_time = $limit[0]['timestamp'];
            $count = $limit[0]['count'];

            // the last review time not less than the gap time.
            if ($last_time + $_USER_REVIEW_LIMIT['GAP'] > $now)
            {
                if ($count >= $_USER_REVIEW_LIMIT['MAX_COUNT'])
                {
                    return false;
                }
            }
        }

        return true;
    }

    public static function addUserReviewLimit($uid, $biz_id, $type)
    {
        global $_USER_REVIEW_LIMIT;
        $now = time();

        $limit = IUserReviewLimitTTC::get($uid, array('biz_id' => $biz_id, 'type' => $type));

        if (false === $limit)
        {
        	exd_Attr_API2(USERREVIEWLIMITTTC_FAILED, 1);
        }else{
        	exd_Attr_API2(USERREVIEWLIMITTTC_SUC, 1);
        }
        
        // any error is allow to review
        if (false === $limit)
        {
            return true;
        }
        // the user not reviewed
        else if (0 === count($limit))
        {
            IUserReviewLimitTTC::insert(array('uid' => $uid, 'biz_id' => $biz_id, 'type' => $type, 'count' => 1, 'timestamp' => $now));

            return true;
        }
        else
        {
            $last_time = $limit[0]['timestamp'];
            $count = $limit[0]['count'];

            // the last review time not less than the gap time.
            if ($last_time + $_USER_REVIEW_LIMIT['GAP'] <= $now)
            {
                IUserReviewLimitTTC::update(array('uid' => $uid, 'count' => 1, 'timestamp' => $now), array('biz_id' => $biz_id, 'type' => $type));

                return true;
            }
            else
            {
                IUserReviewLimitTTC::update(array('uid' => $uid, 'count' => $count+1), array('biz_id' => $biz_id, 'type' => $type));

                return true;
            }
        }

        return true;
    }

    protected static function getSubCategoryIdByType($type_)
    {
        return $type_;
    }
    
    protected static function getSpp($svcName)
    {
        $result = array(
                "data" => "",
                "errorCode" => 0
        );
        $total_svc =configcenter4_get_serv_count($svcName,0);
        $net=configcenter4_get_serv($svcName,0,rand(1,$total_svc));
        if (!isset($net))
        {
            $result["errorCode"] = 1;
            return $result;
        }
        $pos = strpos($net, ":");
        if ($pos === false)
        {
            $result["errorCode"] = 2;
            return $result;
        }

        $ip = substr($net, 0, $pos);
        $port = substr($net, $pos+1);
        $result["data"]=array(
                "ip"=>$ip,
                "port"=>$port
        );
        return $result;
    }

    protected static function getSppByConfig($svcName)
    {
        $result = array(
                "data" => "",
                "errorCode" => 0
        );
        $result=self::getSpp($svcName);
        if($result["errorCode"]!=0)
        {
            $ip = Config::getIP('reviewSystem');
            if (null == $ip)
            {
                return  $result;
            }
            $address = explode(":", $ip);
            $result["data"]=array(
                "ip"=>$address[0],
                "port"=>$address[1]
            );
          
        }
        return $result;
    }

    protected static function sendRequest($cmd_, $is_get_ = false)
    {
       /*  $ip = Config::getIP('reviewSystem');
        if (null == $ip)
        {
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getip(reviewSystem) failed]";
            return  false;
        }

        $address = explode(":", $ip);
        $response_str = NetUtil::tcpCmd($address[0], $address[1], $cmd_, 1, 1, 0, "\r\n"); */
        
        $net = self::getSppByConfig("review_server_list");
        if($net["errorCode"]!=0)
        {
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[getip(reviewSystem) failed]";
            return  false;
        }
        
        $response_str = NetUtil::tcpCmd($net["data"]["ip"], $net["data"]["port"], $cmd_, 1, 1, 0, "\r\n");

        if (false == $response_str || "" == $response_str)
        {
        	exd_Attr_API2(SPP_PROCESS_FAILED, 1);
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[review system ".$net["data"]["ip"].":".$net["data"]["port"]." svr timeout]";
            return  false;
        }
        exd_Attr_API2(SPP_PROCESS_SUC, 1);

        if ($is_get_)
        {
            return $response_str;
        }
        else
        {
             return ToolUtil::gbJsonDecode($response_str);

        }
    }

    protected static function synReviewToERP($review_info_)
    {
        $level = 0;
        $name = '';

        $info = IUser::getUserInfo($review_info_['user_id']);
        $uid = $review_info_['user_id'];
        if ( false === $info)
        {
        	exd_Attr_API2(USER_FAILED, 1);
            self::$errCode = 24;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query $uid from IUser faild, code:".IUser::$errCode.', errMsg:'.IUser::$errMsg;
        }
        else
        {
        	exd_Attr_API2(USER_SUC, 1);
            $level = $info['level'];
            $name = $info['icsonid'];
        }

        $MSDB = Config::getMSDB('ERP_1');
        if (false === $MSDB)
        {
            self::$errCode = Config::$errCode;
            self::$errMsg  = Config::$errMsg;
            Logger::err('[ERP]Add review fail on road 1: ' . self::$errMsg . ', errcode : ' . self::$errCode);
            return false;
        }

        // the score in the short version is double which between 0 and 10
        $review_info_['score'] = $review_info_['score']*2;
        $content = $MSDB->msEscapeStr($review_info_['content']);

        $sql = "INSERT INTO Review_Master
                (
                SysNo, ReviewType, Title, Content1,
                Content2, Content3, Score, OwnedType,
                UnderstandingType, NickName, ReferenceType, ReferenceSysNo,
                IsTop, IsGood, TotalRemarkCount, TotalHelpfulRemarkCount,
                TotalComplainCount, Status, CreateCustomerSysNo, CreateDate,
                LastEditUserSysNo, LastEditDate, CustomerIP,ScoreStatus,SOSysNo, CustomerRank
                )
                VALUES (
                {$review_info_['review_id']}, {$review_info_['type']}, '', '{$content}',
                '', '', {$review_info_['score']}, 0,
                0, '{$name}', {$review_info_['reference_type']}, {$review_info_['reference_id']},
                0, 0, 0, 0,
                0, -1, {$review_info_['user_id']}, GETDATE(),
                {$review_info_['user_id']}, GETDATE(), '{$review_info_['ip']}', 1, {$review_info_['order_id']}, {$level}
                )";

        $ret = $MSDB->execSql($sql);
        if (false === $ret)
        {
            self::$errCode = $MSDB->errCode;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
            Logger::err('[ERP]Add review fail on road 2 : ' . self::$errMsg . ', errcode : ' . self::$errCode);

            return  false;
        }
        Logger::err('[ERP]Add Review on road 3 : sucess');

        return true;
    }


    //Review置顶、精华to erp
     public static  function synReviewTypeToERP($type,$review_id)
    {

        $MSDB = Config::getMSDB('ERP_1');
        if (false === $MSDB)
        {
            self::$errCode = Config::$errCode;
            self::$errMsg  = Config::$errMsg;
            return false;
        }
         if("top" == $type){
            $sql = "UPDATE Review_Master SET IsTop=1 WHERE SysNo=$review_id";
         }else if("untop" == $type){
            $sql = "UPDATE Review_Master SET IsTop=0 WHERE SysNo=$review_id";
         }else if("best" == $type){
            $sql = "UPDATE Review_Master SET IsGood=1 WHERE SysNo=$review_id";
         }else if("unbest" == $type){
            $sql = "UPDATE Review_Master SET IsGood=0 WHERE SysNo=$review_id";
         }
        $ret = $MSDB->execSql($sql);
        if (false === $ret)
        {
            self::$errCode = $MSDB->errCode;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
            return  false;
        }

        return true;
    }


    //Review通过、作废 torp
     public static function synReviewStatusToERP($_status,$review_id)
    {

        $MSDB = Config::getMSDB('ERP_1');
        if (false === $MSDB)
        {
            self::$errCode = Config::$errCode;
            self::$errMsg  = Config::$errMsg;
            return false;
        }

         if("pass" == $_status){
            $sql = "UPDATE Review_Master SET Status=2 WHERE SysNo=$review_id";
         }else if("rejected" == $_status){
            $sql = "UPDATE Review_Master SET Status=-2 WHERE SysNo=$review_id";
         }

        $ret = $MSDB->execSql($sql);
        if (false === $ret)
        {
            self::$errCode = $MSDB->errCode;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
            return  false;
        }

        return true;
    }


    protected static function synReplyToERP($reply_info_)
    {
        $level = 0;
        $name = '';

        $info = IUser::getUserInfo($reply_info_['user_id']);
        if ( false === $info)
        {
        	exd_Attr_API2(USER_FAILED, 1);
            self::$errCode = 24;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "query $uid from IUser faild, code:".IUser::$errCode.', errMsg:'.IUser::$errMsg;
        }
        else
        {
        	exd_Attr_API2(USER_SUC, 1);
            $level = $info['level'];
            $name = $info['icsonid'];
        }

        $MSDB = Config::getMSDB('ERP_1');
        if (false === $MSDB)
        {
            self::$errCode = Config::$errCode;
            self::$errMsg  = Config::$errMsg;
            return false;
        }

        $sql = "begin transaction";
        $ret = $MSDB->execSql($sql);
        if (false === $ret)
        {
            self::$errCode = ERR_MSSQL_TRANSACTION_FAIL;
            self::$errMsg='开启mysql事务失败'.$MSDB->errMsg;
            Logger::err('[ERP]Add Reply fail on road 1 review reply: ' . self::$errMsg . ', errcode : ' . self::$errCode);
            return  false;
        }

        $content = $MSDB->msEscapeStr($reply_info_['content']);
        $name = $MSDB->msEscapeStr($name);

        $sql =  "INSERT INTO Review_Reply
                (SysNo, ReviewSysNo, ReplyContent, Status, CreateUserType,
                CreateUserSysNo, CreateDate, LastEditUserSysNo, LastEditDate, CustomerScore, CustomerID, CustomerRank) VALUES (
                {$reply_info_['reply_id']}, {$reply_info_['review_id']}, '{$content}', 0, 0,
                {$reply_info_['user_id']}, GETDATE(), {$reply_info_['user_id']}, GETDATE(), null, '{$name}', {$level})";

        $ret = $MSDB->execSql($sql);
        if (false === $ret)
        {
            self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
            $sql = "rollback";
            $MSDB->execSql($sql);

            Logger::err('[ERP]Add Reply fail on road 2 review reply: ' . self::$errMsg . ', errcode : ' . $MSDB->errCode);
            return  false;
        }

        $sql = "UPDATE Review_Master SET LastReplySysNo = {$reply_info_['reply_id']}, LastReplyDate = GETDATE()
                WHERE SysNo={$reply_info_['review_id']}";
        $MSDB->execSql($sql);
        if (false === $ret)
        {
            self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
            $sql = "rollback";
            $MSDB->execSql($sql);
            Logger::err('[ERP]Add Reply fail on road 3 review master: ' . self::$errMsg . ', errcode : ' . $MSDB->errCode);
            return  false;
        }
        $sql = "commit";
        $MSDB->execSql($sql);
        Logger::err('[ERP]Add Reply : sucess');

        return true;
    }


    //reply作废to erp
    public static function synReplyStatusToERP($_status,$reply_id)
     {

       $MSDB = Config::getMSDB('ERP_1');
        if (false === $MSDB)
        {
            self::$errCode = Config::$errCode;
            self::$errMsg  = Config::$errMsg;
            return false;
        }

         if("rejected" == $_status){
            $sql = "UPDATE Review_Reply SET Status=1 WHERE SysNo=$reply_id";
         }

        $ret = $MSDB->execSql($sql);
        if (false === $ret)
        {
            self::$errCode = $MSDB->errCode;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
            return  false;
        }

        return true;
    }

    protected static function getScore($user_id_, $price_)
    {
        $score = 0;

        // 价钱单位 从分转化为元
        $price_ = $price_/100;

        // get price level
        if (10 <= $price_ && 200 >= $price_)
        {
            $price_level = 1;
        }
        else if (201 <= $price_ && 500 >= $price_)
        {
            $price_level = 2;
        }
        else if (501 <= $price_ && 1000 >= $price_)
        {
            $price_level = 3;
        }
        else if (1000 <= $price_)
        {
            $price_level = 4;
        }
        else
        {
            return 0;
        }

        //get user level
        $item = IUser::getUserInfo($user_id_);
        if($item == false){
        	exd_Attr_API2(USER_FAILED, 1);
        }else{
        	exd_Attr_API2(USER_SUC, 1);
        }
        
        if (false == $item || count($item) <= 0)
        {
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "get (".$user_id_.") from IUser faild, code:".IUser::$errCode.', errMsg:'.IUser::$errMsg;
            return  false;
        }
        $user_type = $item['type'];
        $user_level = $item['level'];

        global $_USER_TYPE;
        $no_score_user_type = array(
            $_USER_TYPE['SallVIP'],             //("经销商")]
            $_USER_TYPE['Dealer'],              //("炒货商")]
            $_USER_TYPE['EnterpriseUser'],      //("分销商(企业客户)")]
            $_USER_TYPE['ChaohuoUser'],         //("分销商(炒货商)")]
            $_USER_TYPE['WholeSalerUser'],      //("分销商(批发商)")]
            $_USER_TYPE['RetailersUser']        //("分销商(零售商)")]
        );

        if ( in_array($user_type, $no_score_user_type) ) { //炒货商,经销商 ,分销商 企业用户
            self::$errCode = NO_SCORE_USER;
            return 0;
        }

        $ret = IUser::getStatusBits($user_id_, array(NO_SCORE_USER));
        if($ret == false){
        	exd_Attr_API2(USER_FAILED, 1);
        }else{
        	exd_Attr_API2(USER_SUC, 1);
        }
        
        if( $ret===false )
        {
        	exd_Attr_API2(USER_FAILED, 1);
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . " get ($user_id_) from IUser::getStatusBits faild.";
            return  false;
        }else{
        	exd_Attr_API2(USER_SUC, 1);
        }

        if (  $ret[NO_SCORE_USER] ) { //用户积分标志位
            self::$errCode = NO_SCORE_USER;
            self::$errMsg = "user score status bits is false.";
            return 0;
        }

       
        global $_REVIEW_SCORE;
        if (isset($_REVIEW_SCORE[$user_level][$price_level]))
        {
            $score = $_REVIEW_SCORE[$user_level][$price_level];
        }

        return $score;
    }

    //define("REIVEW_FILTER_REQUEST_TEMPLATE", 'uid=%d&cmd=%d&id=%d-%d-%d&ip=%s&content=%s');
    protected static function checkContent($uid_, $id_, $category_id_, $sub_category_id_, $ip_, $content_, $cmd_ = 0)
    {
        $tmp = sprintf(REIVEW_FILTER_REQUEST_TEMPLATE, $uid_, $cmd_, $id_, $category_id_, $sub_category_id_, $ip_, $content_);
        $ip = Config::getIP('reviewFilter');
        if (null == $ip)
        {
            self::$errMsg = "[getip(reviewFilter) failed]";
            self::$errCode = -1;
            Logger::err('Review filter errmsg on road 1: ' . self::$errMsg . ', errcode : ' . self::$errCode . ' MSG : ' . $tmp);
            return -1;
        }

        $address = explode(":", $ip);
        //'uid=%d&cmd=%d&id=%d-%d-%d&ip=%s&content=%s'
        $request = sprintf(REIVEW_FILTER_REQUEST_TEMPLATE, $uid_, $cmd_, $id_, $category_id_, $sub_category_id_, $ip_, urlencode($content_));
        $response = NetUtil::udpCmd($address[0], $address[1], $request, true, 2);

        if($response === false)
        {
        	exd_Attr_API2(REVIEWFILTER_FAILED, 1);
            self::$errMsg = 'connect review filter server fails';
            self::$errCode = -2;
            Logger::err('Review filter errmsg on road 2: ' . self::$errMsg . ', errcode : ' . self::$errCode . ' MSG : ' . $tmp);

            return -2;
        }
        exd_Attr_API2(REVIEWFILTER_SUC, 1);

        $temp = explode('&', $response);
        list($a, $maliceid) = explode('=', $temp[0]);
        if (intval($maliceid) > 0)
        {
            self::$errMsg = "[the review content include the unallow the word]";
            self::$errCode = intval($maliceid);
            Logger::err('Review filter errmsg on road 3: ' . self::$errMsg . ', errcode : ' . self::$errCode. ' MSG : ' . $tmp);

            return 1;
        }
        else if (intval($maliceid) < 0)
        {
            list($a, $replymsg) = explode('=', $temp[1]);
            self::$errMsg = "[review filter has error: $replymsg]";
            self::$errCode = intval($maliceid);
            Logger::err('Review filter errmsg on road 4: ' . self::$errMsg . ', errcode : ' . self::$errCode. ' MSG : ' . $tmp);

            return -3;
        }

        Logger::err('Review filter errmsg on road 5: success MSG : ' . $tmp);

        return 0;
    }

    protected static function checkMaliciousUser($uid_, $type_)
    {
        $ret = array('errCode' => '1',
                     'errMsg' => '',
                     'review_id' => '1',
                     'reply_id' => '1');

        $item = IUserTypeTTC::get($uid_, array('bizid' => 1, 'status' => 1));
        
        if($item === false){
        	exd_Attr_API2(USERTYPETTC_FAILED, 1);
        }else{
        	exd_Attr_API2(USERTYPETTC_SUC, 1);
        }
        
        if (false !== $item && (1 === count($item)))
        {
            $ret['errCode'] = '0';
            Logger::info("Filter malicious review on user : {$uid_}, type : {$type_} ");
        }

        return $ret;
    }
}

?>