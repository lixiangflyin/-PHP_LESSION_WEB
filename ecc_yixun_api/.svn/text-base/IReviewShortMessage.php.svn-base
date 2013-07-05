<?php
define('RLATIVE_USERS_SPLIT', ',');

/**
 * The short message class which deal with the user and system short message in the website, which extends from IReview
 * @author Bill
 *
 */
class IShortMessage extends IReview
{
    /**
     * add the review of product discussion
     * @param uint            $user_id_        reporter's user id
     * @param array(user_id)  $relative_users_ relativity user ids
     * @param string          $title_          title which need to encode
     * @param string          $content_        content which need to encode
     * @return true or false
     */
    public static function addSystemShortMessge($user_id_, $relative_users_, $title_, $content_)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['ADD'], $_REVIEW_CATEGORY['SHORT_MESSAGE'], $_REVIEW_SUB_CATEGORY['SYSTEM_MESSAGE'],
                    0, 0, $user_id_, 0, 0, implode(RLATIVE_USERS_SPLIT, $relative_users_) , 0, ToolUtil::getClientIP(),
                    ToolUtil::escapeTransStr($content_), ToolUtil::escapeTransStr($title_));

        return IReview::sendRequest($cmd);
    }

    /**
     * @brief get received system message
     * @param uint  $user_id_     user id
     * @param uint  $quantity_    the quantity to get
     * @param uint  $begin_       the begin page
     * @return the json object
     */
    public static function getReceivedSystemMessage($user_id_, $begin_ = 0, $quantity_ = 0)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        //  1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['GET'], $_REVIEW_CATEGORY['RECEIVE_MESSAGE'], $_REVIEW_SUB_CATEGORY['SYSTEM_MESSAGE'],
                    0, 0, $user_id_, $quantity_, $begin_, "", 0, "", "", "");

        return IReview::sendRequest($cmd, true);
    }

    /**
     * get the user unreview received short message count
     * @param uint $user_id_ user id
     * @return the json object
     */
    public static function getUnreviewReceivedMessageCount($user_id_)
    {
        return self::getReceivedMessageCount($user_id_, 'UNREVIEW');
    }

    /**
     * get the user received short message count
     * @param uint $user_id_ user id
     * @return the json object
     */
    public static function getReceivedMessageCount($user_id_, $type_ = 'ALL')
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['GET'], $_REVIEW_CATEGORY['STATISTIC_RECEIVE_MESSAGE'], $_REVIEW_SUB_CATEGORY[$type_],
                    0, 0, $user_id_, 0, 0, "", 0, "", "", "");

        return IReview::sendRequest($cmd, true);
    }


    /**
     * set short message's status as reviewed.
     * @param uint $review_id_ review id
     * @param uint $user_id_   user id
     * @return true or false
     */
    public static function updateReceivedMessageStatus($review_id_, $user_id_, $status_ = 'REVIEWED')
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        global $_REVIEW_ATTRIBUTE_TYPE;
        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['UPDATE'], $_REVIEW_CATEGORY['ATTRIBUTE_RECEIVE_MESSAGE'], $_REVIEW_SUB_CATEGORY['SYSTEM_MESSAGE'],
                    0, $review_id_, $user_id_, 0, 0, "", $_REVIEW_ATTRIBUTE_TYPE[$status_], "", "", "");

        return IReview::sendRequest($cmd);
    }
    

    /**
     * delete received message
     * @param uint $review_id_ review id
     * @param uint $user_id_   user id
     * @return true or false
     */
    public static function deleteReceivedMessage($review_id_, $user_id_)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        global $_REVIEW_ATTRIBUTE_TYPE;
        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['UPDATE'], $_REVIEW_CATEGORY['ATTRIBUTE_RECEIVE_MESSAGE'], $_REVIEW_SUB_CATEGORY['SYSTEM_MESSAGE'],
                    0, $review_id_, $user_id_, 0, 0, "", $_REVIEW_ATTRIBUTE_TYPE['DELETED'], "", "", "");

        return IReview::sendRequest($cmd);
    }
}