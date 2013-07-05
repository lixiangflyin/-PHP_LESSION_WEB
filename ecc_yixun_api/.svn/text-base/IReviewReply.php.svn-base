<?php
/**
 * the class of review's reply
 * @author Bill
 *
 */
class IReply extends IReview
{
    public static $errCode = 0;
    public static $errMsg = '';

    /**
     * add the reply to review
     * @param uint   $review_id_  review id
     * @param uint   $user_id_    user id
     * @param string $content_    reply content
     */
    public static function addReply($review_id_, $user_id_, $relative_user_id_, $type_, $content_)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        $ip = ToolUtil::getClientIP();
        $subCategroy = IReview::getSubCategoryIdByType($type_);
        $category = $_REVIEW_CATEGORY['REVIEW_REPLY'];
        $newId = IIdGenerator::getNewId('review_reply_sequence');
        if (false === $newId || $newId <= 0) {
        	exd_Attr_API2(IDGENERATOR_FAILED, 1);
            self::$errCode = IIdGenerator::$errCode;
            self::$errMsg = IIdGenerator::$errMsg;
            return false;
        }
        exd_Attr_API2(IDGENERATOR_SUC, 1);
        $ret = IReview::checkContent($user_id_, $review_id_, $newId, $subCategroy, $ip, $content_, 1);
        if ($ret > 0)
        {
        	return -1;
        }

        // 过滤恶意用户名单中用户的评论，其发表的评论直接忽略，不加入到评论系统中。
        $ret = IReview::checkMaliciousUser($user_id_, $subCategroy);
        if ('0' === $ret['errCode'])
        {
            self::addUserReviewLimit($user_id_, $category, 0);
        	return $ret;
        }

        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(SYN_REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['ADD'], $category, $subCategroy,
                    $newId, $review_id_, $user_id_, time(), time(),$relative_user_id_, 0, $ip,
                    ToolUtil::escapeTransStr($content_), "", 1);

        $ret = IReview::sendRequest($cmd);
        if ('0' === $ret['errCode'])
        {
            $reply_info = array(
                'reply_id'  => $ret['reply_id'],
                'review_id' => $review_id_,
                'content'   => addslashes($content_),
                'user_id'   => $user_id_);
            IReview::synReplyToERP($reply_info);
        }

        if ('0' === $ret['errCode'])
        {
            self::addUserReviewLimit($user_id_, $category, 0);
        }

        return $ret;
    }

    /**
     * get replies
     * @param uint  $product_id_  product id
     * @param uint  $quantity_    the quantity to get
     * @param uint  $begin_       the begin page
     * @return the json object
     */
    public static function getReplies($review_id_, $type_, $begin_ = 0, $quantity_ = 0)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['GET'], $_REVIEW_CATEGORY['REVIEW_REPLY'], IReview::getSubCategoryIdByType($type_),
                    0, $review_id_, 0, $quantity_, $begin_, "", 0, "", "", "");

        return IReview::sendRequest($cmd, true);
    }

    /**
     * check the user whether allow to asking
     * @param uint  $uid  user id
     * @return bool
     */
    public static function checkUserReviewLimit($uid)
    {
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;

        return IReview::checkUserReviewLimit($uid, $_REVIEW_CATEGORY['REVIEW_REPLY'], 0);
    }
    
    //回复作废
	public static function setStatus($reply_id_, $review_id_, $user_id_, $type_, $status_ = "APPROVED")
	    {
	        global $_REVIEW_CMD;
	        global $_REVIEW_CATEGORY;
	        global $_REVIEW_SUB_CATEGORY;
	        global $_REVIEW_ATTRIBUTE_TYPE;
	        // 1      2             3                4            5           6      7           8        9      10       11    12
	        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
	        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
	                    $_REVIEW_CMD['UPDATE'], $_REVIEW_CATEGORY['REPLY_ATTRIBUTE'], IReview::getSubCategoryIdByType($type_),
	                    $reply_id_, $review_id_, $user_id_, 0, "", 0, $_REVIEW_ATTRIBUTE_TYPE[$status_], "", "", "");
	        return IReview::sendRequest($cmd, true);
	    }
}
?>