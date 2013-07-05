<?php
require_once(ROOT_DIR . 'api/IReview.php');
require_once(ROOT_DIR . 'api/IReviewIdGenerator.php');

/**
 * 评论回复相关接口，用于后台系统专用，前台勿用！
 * @author mackwang
 *
 */
class IReplyAdmin extends IReview
{
    public static $errCode = 0;
    public static $errMsg = '';

    /**
     * 添加评论回复
     * 
     * @param uint   $review_id_  review id
     * @param uint   $user_id_    user id
     * @param string $content_    reply内容
     * @param uint   $relative_user_id_ 回复对象的用户id
     * @param uint   $type_         回复类型
     *                  SATISFIED   :1 满意评论
     *                  GENERAL     :2 一般评论
     *                  UNSATISFIED :3 不满意评论
     *                  DISCUSSION  :4 讨论
     *                  ASKING      :5 咨询
     * @param uint   $type_         
     *                易迅网回复    :7 @see $_REVIEW_CATEGORY['ICSON_REPLY']
     * @return 
     * 
     * 失败:false,
     * 
     * 成功:
     * array(3) {
     *   "errCode"=>    string(1) "0"
     *   "errMsg"=>     string(0) ""
     *   "reply_id"=>   string(1) "0"
     * }
     */
    public static function addReply($review_id_, $user_id_, $relative_user_id_, $content_, $type_, $category_ = 7)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        $ip = ToolUtil::getClientIP();
        $subCategroy = $type_;
        $category = $category_;
        $newId = IReviewIdGenerator::getNewId('review_reply_sequence');
        if (false === $newId || $newId <= 0) {
            self::$errCode = IIdGenerator::$errCode;
            self::$errMsg = IIdGenerator::$errMsg;
            return false;
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
            if(isset($ret['reply_id']) && $ret['reply_id'] != $newId)
            {
                $ret['reply_id'] = $newId;
            }
        }
        return $ret;
    }  
}
?>
