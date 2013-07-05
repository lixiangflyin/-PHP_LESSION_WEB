<?php
//require_once('IReview.php');
require_once(PHPLIB_ROOT . 'inc/constant.inc.php');
//require_once('IScore.php');
//require_once('inc/IProductInfoTTC.php');
//require_once(PHPLIB_ROOT . 'api/IService.php');
require_once(PHPLIB_ROOT . 'api/IServiceV2.php');
require_once(PHPLIB_ROOT . 'api/IOrder.php');

/**
 * The reviews class which deal with the product review, which extends from IReview
 * @author Bill
 *
 */
class IReviews extends IReview
{
    /**
     * add the review of product discussion
     * @param uint   $product_id_  product id
     * @param uint   $user_id_     reporter's user id
     * @param string $content_     content which need to encode
     * @return true or false
     */
    public static function addProductDiscussion($product_id_, $user_id_, $content_)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        $ip = ToolUtil::getClientIP();
        $subCategroy = $_REVIEW_SUB_CATEGORY['DISCUSSION'];
        $category = $_REVIEW_CATEGORY['PRODUCT_REVIEW'];
        $newId = IIdGenerator::getNewId('Review_Sequence');
        if (false === $newId || $newId <= 0) {
        	exd_Attr_API2(IDGENERATOR_FAILED, 1);
            self::$errCode = 1001;
            self::$errMsg = 'gen id fail! errCode:' . IIdGenerator::$errCode . ', errMsg:' . IIdGenerator::$errMsg;
            return false;
        }
        exd_Attr_API2(IDGENERATOR_SUC, 1);

        $ret = IReview::checkContent($user_id_, $product_id_, $newId, $subCategroy, $ip, $content_);
        if ($ret > 0)
        {
            return -1;
        }

        // 过滤恶意用户名单中用户的评论，其发表的评论直接忽略，不加入到评论系统中。
        $ret = IReview::checkMaliciousUser($user_id_, $subCategroy);
        if ('0' === $ret['errCode'])
        {
            self::addUserReviewLimit($user_id_, $category, $subCategroy);
        	return $ret;
        }

        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(SYN_REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['ADD'], $category, $subCategroy,
                    $product_id_, $newId, $user_id_, time(), time(), "", 0, $ip, ToolUtil::escapeTransStr($content_), "", 1);

        $ret = IReview::sendRequest($cmd);
        if ('0' === $ret['errCode'])
        {
            $review_info = array(
                'review_id' => $ret['review_id'],
                'type'      => 2,
                'content'   => addslashes($content_),
                'reference_id'=> $product_id_,
                'score'     => 5,
                'user_id'   => $user_id_,
                'ip'        => $ip,
                'order_id'  => 0,
                'reference_type' => 0,);

            IReview::synReviewToERP($review_info);
        }

        if ('0' === $ret['errCode'])
        {
            self::addUserReviewLimit($user_id_, $subCategroy, $subCategroy);
        }

        return $ret;
    }
    
    
     public static function _getDealTime($time){
        
        $orderurge_deal_time = 1800;

        $month = date('n', $time);
        $day   = date('j', $time);
        $year  = date('Y', $time);

        if($time >= mktime(0, 0, 0, $month, $day, $year) && $time <= mktime(9, 0, 0, $month, $day, $year)){
            // 0 - 9点: 9 + $orderurge_deal_time
            $exp_deal_time = mktime(9, 0, 0, $month, $day, $year) + $orderurge_deal_time;
        }elseif($time > mktime(9, 0, 0, $month, $day, $year) && $time <= (mktime(0, 0, 0, $month, (int)($day + 1), $year) - $orderurge_deal_time)){
            // 9 - (24-$orderurge_deal_time): $time + $orderurge_deal_time
            $exp_deal_time = $time + $orderurge_deal_time;
        }else{
            // (24-$orderurge_deal_time) - 24: $time + $orderurge_deal_time + 9 * 3600
            $exp_deal_time = $time + $orderurge_deal_time + 3600 * 9;
        }

        return $exp_deal_time;
    }
    
    public static function _getCompTime($time){
        

        $orderurge_comp_time =12*60*60;

        $month = date('n', $time);
        $day   = date('j', $time);
        $year  = date('Y', $time);

        if($time >= mktime(0, 0, 0, $month, $day, $year) && $time <= mktime(9, 0, 0, $month, $day, $year)){
            // 0 - 9点: 9 + $orderurge_comp_time
            $exp_comp_time = mktime(9, 0, 0, $month, $day, $year) + $orderurge_comp_time;
        }elseif($time > mktime(9, 0, 0, $month, $day, $year) && $time <= (mktime(0, 0, 0, $month, (int)($day + 1), $year) - $orderurge_comp_time)){
            // 9 - (24-$orderurge_comp_time): $time + $orderurge_comp_time
            $exp_comp_time = $time + $orderurge_comp_time;
        }else{
            // (24-$orderurge_comp_time) - 24: $time + $orderurge_comp_time + 9 * 3600
            $exp_comp_time = $time + $orderurge_comp_time + 3600 * 9;
        }

        return $exp_comp_time;
    }
    /**
     * add the review of product experience, it should add review, add the topic of satisfaction,
     * and add the vote of product performance
     * @param uint   $product_id_    product id
     * @param uint   $user_id_       reporter's user id
     * @param string $content_       content which need to encode
     * @param uint   $satisfaction_  the score of satisfaction
     * @param array(array('performance_category_id' => 'score'))
     *               $performance_   the vote of product performance
     * @return mixed int 用户评论获得的积分数；true or false 评论成功或失败
     */
    public static function addProductExperience($product_id_, $user_id_, $content_, $satisfaction_, $order_id_, $product_char_id_, $product_price_, $product_num=1, $wh_id,$product_class_id=0)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_SCORE_TYPE;
        global $_REVIEW_SUB_CATEGORY;

		$times = 1;

		//此处先拉取该商品的前5位的评论者。
		$r_ret = IReviews::getProductReviewProperty($product_id_,false);
		// if($r_ret)
		// {
			// $uids_top = array();
			// foreach($r_ret['top_users'] as $user)
			// {
				// $uids_top[] = $user['id'];
			// }
			// if ((TOP_USERS_NUMBER > count($r_ret['top_users'])) && !in_array($user_id_,$uids_top,false))
			// {
				// $times = 2;
			// }
		// }

		if($r_ret) {
			$total = $r_ret['satisfied'] + $r_ret['general'] + $r_ret['unsatisfied'];
			$times = (TOP_USERS_NUMBER > $total) ? 2 : 1;
		}
       
        $ip = ToolUtil::getClientIP();
        $newId = IIdGenerator::getNewId('Review_Sequence');
        if (false === $newId || $newId <= 0) {
        	exd_Attr_API2(IDGENERATOR_FAILED, 1);
            
            self::$errCode = 1001;
            self::$errMsg = 'gen id fail! errCode:' . IIdGenerator::$errCode . ', errMsg:' . IIdGenerator::$errMsg;
             Logger::info("===========================".self::$errMsg);
           
            return false;
        }        
      
        exd_Attr_API2(IDGENERATOR_SUC, 1);
        // 体验评论数据上报旁路系统，但不进行频率限制
        if ($satisfaction_ > 3)
        {
        	$type = $_REVIEW_SUB_CATEGORY['SATISFIED'];
        }
        else if ($satisfaction_ < 3)
        {
        	$type = $_REVIEW_SUB_CATEGORY['UNSATISFIED'];
        }
        else
        {
        	$type = $_REVIEW_SUB_CATEGORY['GENERAL'];
        }
        IReview::checkContent($user_id_, $product_id_, $newId, $type, $ip, $content_);

        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(SYN_REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['ADD'], $_REVIEW_CATEGORY['PRODUCT_REVIEW'], 0,
                    $product_id_, $newId, $user_id_, time(), time(), "", $satisfaction_, $ip, ToolUtil::escapeTransStr($content_), "", 1);

        $ret = IReview::sendRequest($cmd);
        if ($ret === false) {
        	self::$errCode = 1002;
            self::$errMsg = 'IReview::sendRequest failed ! errCode:' . IReview::$errCode . ', errMsg:' . IReview::$errMsg;
             Logger::info("===========================".self::$errMsg);
            return false;
        }
        if (isset($ret['errCode']) && '0' === $ret['errCode']) {
            $review_info = array(
                'review_id' => $ret['review_id'],
                'type'      => 1,
                'content'   => addslashes($content_),
                'reference_id'=> $product_id_,
                'score'     => $satisfaction_,
                'user_id'   => $user_id_,
                'ip'        => $ip,
                'order_id'  => $order_id_,
                'reference_type' => 0,
            );

            $syncRet = IReview::synReviewToERP($review_info);
            if($syncRet === false){
                Logger::err('synReviewToERP Error errCode:' . IReview::$errCode . ', errMsg:' . IReview::$errMsg." ".print_r($review_info,true));
            }
            if($satisfaction_ <= 3)//这里需要上报客服,这里需要查下订单里面的mobile,然后提交给
            {
                $orderinfo=IOrder::getOneOrderDetail($user_id_,$order_id_);
                Logger::info("Get OneOrderDetail Error! code:".IOrder::$errCode."Msg:".IOrder::$errMsg);
                if($orderinfo !== false)
                {
                    #12：满意   13:一般   14:不满意 与kevazhang沟通
                	$serviceType_ = 14;
                    if ($satisfaction_ > 3)
                    {
                        $serviceType_ = 12;
                    }
                    if ($satisfaction_ == 3)
                    {
                        $serviceType_ = 13;
                    }                    
                   
                    //$product_id_, $user_id_, $content_, $satisfaction_, $order_id_, $product_char_id_, $product_price_, $product_num=1, $wh_id,$product_class_id=0
                    //是否是VIP
                    $isVIP = 0;
                    $time = time();
                    $vipInfo = IServiceV2::getVipUserInfo($user_id_);
                    if($vipInfo && $vipInfo['data']['is_vip'] == 1) {
                        $isVIP = 1;
                    }
                    
                    #Logger::info("IServiceV2::getVipUserInfo  ".print_r($vipInfo,true));
                    $userInfo  = IUser::getUserInfo($user_id_);
                    #Logger::info("IUser::getUserInfo  ".print_r($userInfo,true));
                    $icsonId   = $userInfo['icsonid'];
                    $userType  = (false === strpos($icsonId, 'Login_QQ')) ? 2 : 1;
                    $userName  = $userInfo['name'];
                    $userLevel = $userInfo['level'];
                    $baseInfo = array(
                            'source'         => 1,
                            'biz'            => 1,
                            'siteID'         => $wh_id,
                            'type'           => 9,
                            'account'        => (String)$user_id_,
                            'userType'       => $userType,
                            'userName'       => $userName,
                            'userPhone'      => $orderinfo["receiver_mobile"],
                            'isVIP'          => $isVIP,
                            'creator'        => (String)$user_id_,
                            'state'          => 1,
                            'productdCate'    => $product_class_id,
                            'orderNo'		 => $order_id_,
                            'createTime'     => (int)$time,
                            'ext2'           => $userLevel,
                            'ext4'           => $product_id_.":".$newId
                    );
                    $subtype=0;
                    
                    if($satisfaction_<3)
                        $subtype=903;//cha
                    else if($satisfaction_==3)
                        $subtype=902;//zhong 
                    else if($satisfaction>3)
                         $subtype=901;//hao

                    $_orderState = self::_fetchOrderStatusDesc($orderinfo['status']);

                    $applyInfo = array(	
                            'content'        => (String)$content_,
                            'est_comp_time'  => IReviews::_getCompTime($time),
                            'est_deal_time'  => IReviews::_getDealTime($time),
                            'order_state'    => $_orderState,
                            'subtype'       =>$subtype
                    );
                    Logger::info("IServiceV2::addToApply  ".print_r($baseInfo,true)."  ".print_r($applyInfo,true));
                    $ret = IServiceV2::addToApply($user_id_, $baseInfo, $applyInfo);
                   // Logger::info("IService::addToApply(user_id_:$user_id_,satisfaction_:$satisfaction_,serviceType:$serviceType_,order_id_:$order_id_,receiver_mobile:".$orderinfo["receiver_mobile"]."receiver_tel:".$orderinfo["receiver_tel"]."product_id_:newId=${product_id_}:${newId},content_:$content_)");
                   // $result=IService::addToApply($user_id_,4 , $serviceType_, $order_id_, 0, $orderinfo["receiver_mobile"], $orderinfo["receiver_tel"], $product_id_.":".$newId, $content_, true);
                    if($ret['errno'] !== 0)
                    {
                    	exd_Attr_API2(SERVICE_FAILED, 1);
                        Logger::err('IServiceV2::AddToApply Error,'.print_r($ret,true)." ".print_r($baseInfo,true));
                    }else{
                    	exd_Attr_API2(SERVICE_SUC, 1);
                        Logger::err('IServiceV2::AddToApply Suc,'.print_r($ret,true)." ".print_r($baseInfo,true));
                    }
                }
            }
  
			//ixiuzeng添加，二手商品只能评论，不给积分
			global $_ProductType;
			$p_ret = IProductInfoTTC::get($product_id_, array('wh_id'=>$wh_id), array('product_id','type'));
			if(false === $p_ret) {
				exd_Attr_API2(PRODUCTINFOTTC_FAILED, 1);
				Logger::err('IProductInfoTTC::get failed ! errCode:' . IProductInfoTTC::$errCode . ', errMsg:' . IProductInfoTTC::$errMsg);
			} else {
				exd_Attr_API2(PRODUCTINFOTTC_SUC, 1);
				if($p_ret[0]['type'] == $_ProductType['SecondHand']) {
					$ret = 0;
				} else {
					$classids=array(2081,2082,45400);//2061:2081,2082,45400
					if(!in_array($product_class_id,$classids)){
						$addScore = IScoreAoImp::addScore($user_id_,30,$product_id_,$review_info['review_id'],$product_price_); 
						if($addScore == false){
							self::$errMsg = 'IScoreAoImp::addScore failed ! errCode:' . IReview::$errCode . ', errMsg:' . IReview::$errMsg;
							Logger::info("===========================".IScoreAoImp::$errMsg);
							exd_Attr_API2(SCORE_FAILED, 1);
						}else{
							exd_Attr_API2(SCORE_SUC, 1);
						}
						if ($addScore === false) {
							Logger::err('IScore::addScore failed! errCode:'.IScore::$errCode.', errMsg:'.IScore::$errMsg);
						}
					}else{
						 Logger::info("no need add score".$user_id_."  pid:".$product_id_);
					}
				}
			}
        }
        return $ret;
    }

    /**
     * 转换订单状态到文字
     */
    private static function _fetchOrderStatusDesc($status) {
        global $_OrderState;

        foreach ($_OrderState as $idx => $info) {
            if ($status == $info['value']) {
                return $info['desc'];
            }
        }
        return '';
    }


    /**
     * get all product reviews, include satisfied experience, unsatisfied experience, discussion reviews
     * @param uint  $product_id_  product id
     * @param uint  $quantity_    the quantity to get
     * @param uint  $begin_       the begin page
     * @return the json object
     */
    public static function getAllProductReview($product_id_, $begin_ = 0, $quantity_ = 0)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['GET'], $_REVIEW_CATEGORY['PRODUCT_REVIEW'], $_REVIEW_SUB_CATEGORY['ALL'],
                    $product_id_, 0, 0, $quantity_, $begin_, "", 0, "", "", "");

        return IReview::sendRequest($cmd, true);
    }
    
    /**
     * 获取置顶评论
     * 
     * 
     * @param uint  $product_id_  商品id
     * @param uint  $quantity_    the quantity to get
     * @param uint  $begin_       the begin page，数据index，假如每页10条，第一页为0，第二页10，第三页20...
     * @return the json object 
     * 失败返回:false
     * 成功返回数据，以/r/n结尾：
     * 空数据返回：[]\r\n
     * 非空则为：[json数组]\r\n
     * eg:
     * 		$returnVal = IReviews::getProductTopReview($product_id_,0,10);
     * 		if($returnVal === false){
     * 			//返回失败
     * 		}
     * 		$returnVal = ToolUtil::gbJsonDecode($returnVal);
     * 		if($returnVal === "" ){
     * 			//空数据
     * 		}else{
     * 			//数据
     * 		}
     */
    public static function getProductTopReview($product_id_, $begin_ = 0, $quantity_ = 0)
    {
    	global $_REVIEW_CMD;
    	global $_REVIEW_CATEGORY;
    	global $_REVIEW_SUB_CATEGORY;
    	// 1      2             3                4            5           6      7           8        9      10       11    12
    	//cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d&flag
    	$cmd = sprintf(REIVEW_WITH_FLAG_REQUEST_TEMPLATE,
    			$_REVIEW_CMD['GET'], $_REVIEW_CATEGORY['PRODUCT_REVIEW'], $_REVIEW_SUB_CATEGORY['ALL'],
    			$product_id_, 0, 0, $quantity_, $begin_, "", 0, "", "", "",1);
    
    	return IReview::sendRequest($cmd, true);
    }

    /**
     * get satisfied experience reviews
     * @param uint  $product_id_  product id
     * @param uint  $quantity_    the quantity to get
     * @param uint  $begin_       the begin page
     * @return the json object
     */
    public static function getProductSatisfiedExperience($product_id_, $begin_ = 0, $quantity_ = 0)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['GET'], $_REVIEW_CATEGORY['PRODUCT_REVIEW'], $_REVIEW_SUB_CATEGORY['SATISFIED'],
                    $product_id_, 0, 0, $quantity_, $begin_, "", 0, "", "", "");

        return IReview::sendRequest($cmd, true);
    }

    /**
     * get unsatisfied experience reviews
     * @param uint  $product_id_  product id
     * @param uint  $quantity_    the quantity to get
     * @param uint  $begin_       the begin page
     * @return the json object
     */
    public static function getProductUnsatisfiedExperience($product_id_, $begin_ = 0, $quantity_ = 0)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['GET'], $_REVIEW_CATEGORY['PRODUCT_REVIEW'], $_REVIEW_SUB_CATEGORY['UNSATISFIED'],
                    $product_id_, 0, 0, $quantity_, $begin_, "", 0, "", "", "");

        return IReview::sendRequest($cmd, true);
    }

    /**
     * get general experience reviews
     * @param uint  $product_id_  product id
     * @param uint  $quantity_    the quantity to get
     * @param uint  $begin_       the begin page
     * @return the json object
     */
    public static function getProductGeneralExperience($product_id_, $begin_ = 0, $quantity_ = 0)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['GET'], $_REVIEW_CATEGORY['PRODUCT_REVIEW'], $_REVIEW_SUB_CATEGORY['GENERAL'],
                    $product_id_, 0, 0, $quantity_, $begin_, "", 0, "", "", "");

        return IReview::sendRequest($cmd, true);
    }

    /**
     * get discussion reviews
     * @param uint  $product_id_  product id
     * @param uint  $quantity_    the quantity to get
     * @param uint  $begin_       the begin page
     * @return the json object
     */
    public static function getProductDiscussion($product_id_, $begin_ = 0, $quantity_ = 0)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['GET'], $_REVIEW_CATEGORY['PRODUCT_REVIEW'], $_REVIEW_SUB_CATEGORY['DISCUSSION'],
                    $product_id_, 0, 0, $quantity_, $begin_, "", 0, "", "", "");

        return IReview::sendRequest($cmd, true);
    }

    /**
     * get the product review property, which include satisfaction, top reporter
     * @param uint   $product_id_      product id
     * @param string $property_       property
     * @param boolean $is_json_       is in json format
     * @return the json object
     */
    public static function getProductReviewProperty($product_id_, $is_json_ = true, $property_ = "ALL_REVIEWS")
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;

        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['GET'], $_REVIEW_CATEGORY['STATISTIC_REVIEW'], $_REVIEW_SUB_CATEGORY[$property_],
                    $product_id_, 0, 0, 0, 0, "", 0, "", "", "");
        return IReview::sendRequest($cmd, $is_json_);
    }

    /**
     * get the product review number which include product experience and discussion
     * @param array(int)   $product_ids_      product ids
     * @param boolean      $is_json_          is in json format
     * @return the json object array(product_id => count, )
     */
    public static function getProductsReviewCount($product_ids_, $is_json_ = true)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;

        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['GET'], $_REVIEW_CATEGORY['STATISTIC_REVIEW'], $_REVIEW_SUB_CATEGORY['BATCH'],
                    0, 0, 0, 0, 0, implode(',', array_splice($product_ids_, 0, 32)), 0, "", "", "");
        return IReview::sendRequest($cmd, $is_json_);
    }

    /**
     * get the product reivew count, which include satisfied experience, unsatisfied experience, discussion reviews
     * @param uint $product_id_ product id
     * @return the json object
     */
    public static function getProductReviewCount($product_id_)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['GET'], $_REVIEW_CATEGORY['STATISTIC_REVIEW'], $_REVIEW_SUB_CATEGORY['ALL'],
                    $product_id_, 0, 0, 0, 0, "", 0, "", "", "");

        return IReview::sendRequest($cmd, true);
    }

    public static function isTopReviews($product_id_)
    {
        $ret = IReviews::getProductReviewProperty($product_id_, 'TOPREVIEWS');
        if ($ret)
        {
            $ret = mb_convert_encoding($ret, 'UTF-8', 'GBK');
            $ret = json_decode($ret, true);
            if (TOP_USERS_NUMBER > count($ret['top_users']))
            {
                return true;
            }
        }

        return false;
    }

    /**
     * check the user whether allow to asking
     * @param uint  $uid  user id
     * @return bool
     */
    public static function checkUserReviewLimit($uid, $type='DISCUSSION')
    {
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;

        return IReview::checkUserReviewLimit($uid, $_REVIEW_CATEGORY['PRODUCT_REVIEW'], $_REVIEW_SUB_CATEGORY[$type]);
    }
}

?>
