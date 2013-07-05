<?php
/**
 * The asking class which deal with the product asking, which extends from IReview
 * @author Bill
 *
 */
class IAsking extends IReview
{
    /**
     * add the asking of product
     * @param uint   $product_id_  product id
     * @param uint   $user_id_     reporter's user id
     * @param string $content_     content which need to encode
     * @return true or false
     */
    public static function addProductAsking($product_id_, $user_id_, $content_)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        $ip = ToolUtil::getClientIP();
        $subCategroy = $_REVIEW_SUB_CATEGORY['ASKING'];
        $category = $_REVIEW_CATEGORY['PRODUCT_ASKING'];
        $newId = IIdGenerator::getNewId('Review_Sequence');
        if (false === $newId || $newId <= 0) {
        	exd_Attr_API2(IDGENERATOR_FAILED, 1);
            self::$errCode = IIdGenerator::$errCode;
            self::$errMsg = IIdGenerator::$errMsg;
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
            self::addUserReviewLimit($user_id_, $category, 0);
        	return $ret;
        }

        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(SYN_REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['ADD'], $_REVIEW_CATEGORY['PRODUCT_ASKING'], $_REVIEW_SUB_CATEGORY['ASKING'],
                    $product_id_, $newId, $user_id_, time(), time(), "", 0, $ip, ToolUtil::escapeTransStr($content_), "", 1);

        $ret = IReview::sendRequest($cmd);
        if ('0' === $ret['errCode'])
        {
            $review_info = array(
                'review_id' => $ret['review_id'],
                'type'      => 4,
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
            self::addUserReviewLimit($user_id_, $category, 0);
        }

        return $ret;
    }

    /**
     * add the asking of invoice and maintenace
     * @param uint   $product_id_  product id
     * @param uint   $user_id_     reporter's user id
     * @param string $content_     content which need to encode
     * @return true or false
     */
    public static function addProductInvoiceAndMaintAsking($product_id_, $user_id_, $content_)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        $ip = ToolUtil::getClientIP();
        $subCategroy = $_REVIEW_SUB_CATEGORY['INVOICE'];
        $category = $_REVIEW_CATEGORY['PRODUCT_ASKING'];
        $newId = IIdGenerator::getNewId('Review_Sequence');
        if (false === $newId || $newId <= 0) {
        	exd_Attr_API2(IDGENERATOR_FAILED, 1);
            self::$errCode = IIdGenerator::$errCode;
            self::$errMsg = IIdGenerator::$errMsg;
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
            self::addUserReviewLimit($user_id_, $category, 0);
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
                'type'      => 4,
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
            self::addUserReviewLimit($user_id_, $category, 0);
        }

        return $ret;
    }

    /**
     * add the asking of transport and pay asking
     * @param uint   $product_id_  product id
     * @param uint   $user_id_     reporter's user id
     * @param string $content_     content which need to encode
     * @return true or false
     */
    public static function addProductTransAndPayAsking($product_id_, $user_id_, $content_)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        $ip = ToolUtil::getClientIP();
        $subCategroy = $_REVIEW_SUB_CATEGORY['TRANSPORT'];
        $category = $_REVIEW_CATEGORY['PRODUCT_ASKING'];
        $newId = IIdGenerator::getNewId('Review_Sequence');
        if (false === $newId || $newId <= 0) {
        	exd_Attr_API2(IDGENERATOR_FAILED, 1);
            self::$errCode = IIdGenerator::$errCode;
            self::$errMsg = IIdGenerator::$errMsg;
            return false;
        }
        exd_Attr_API2(IDGENERATOR_SUC, 1);
        $ret = IReview::checkContent($user_id_, $product_id_, $newId, $subCategroy, $ip, $content_);
        if ('0' === $ret['errCode'])
        {
            self::addUserReviewLimit($user_id_, $category, 0);
        	return $ret;
        }

        // 过滤恶意用户名单中用户的评论，其发表的评论直接忽略，不加入到评论系统中。
        $ret = IReview::checkMaliciousUser($user_id_, $subCategroy);
        if ('0' === $ret['errCode'])
        {
        	return true;
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
                'type'      => 4,
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
            self::addUserReviewLimit($user_id_, $category, 0);
        }

        return $ret;
    }

    public static function getProductAskingCount($product_id_)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['GET'], $_REVIEW_CATEGORY['STATISTIC_ASKING'], $_REVIEW_SUB_CATEGORY['ALL'],
                    $product_id_, 0, 0, 0, 0, "", 0, "", "", "");

        return IReview::sendRequest($cmd, true);
    }

    /**
     * get all product asking, include product, invoice and maintenace, transport and pay asking
     * @param uint  $product_id_  product id
     * @param uint  $quantity_    the quantity to get
     * @param uint  $begin_       the begin page
     * @return the json object
     */
    public static function getAllProductAsking($product_id_, $begin_ = 0, $quantity_ = 0)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['GET'], $_REVIEW_CATEGORY['PRODUCT_ASKING'], $_REVIEW_SUB_CATEGORY['ALL'],
                    $product_id_, 0, 0, $quantity_, $begin_, "", 0, "", "", "");

        return IReview::sendRequest($cmd, true);
    }

    /**
     * get all product asking, include product, invoice and maintenace, transport and pay asking
     * @param uint  $product_id_  product id
     * @param uint  $quantity_    the quantity to get
     * @param uint  $begin_       the begin page
     * @return the json object
     */
    public static function getAllUserAsking($user_id_, $begin_ = 0, $quantity_ = 0)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['GET'], $_REVIEW_CATEGORY['USER_ASKING'], $_REVIEW_SUB_CATEGORY['ALL'],
                    0, 0, $user_id_, $quantity_, $begin_, "", 0, "", "", "");

        return IReview::sendRequest($cmd, true);
    }

    /**
     * get all product asking
     * @param uint  $product_id_  product id
     * @param uint  $quantity_    the quantity to get
     * @param uint  $begin_       the begin page
     * @return the json object
     */
    public static function getProductAsking($product_id_, $begin_ = 0, $quantity_ = 0)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['GET'], $_REVIEW_CATEGORY['PRODUCT_ASKING'], $_REVIEW_SUB_CATEGORY['ASKING'],
                    $product_id_, 0, 0, $quantity_, $begin_, "", 0, "", "", "");

        return IReview::sendRequest($cmd, true);
    }

    /**
     * get all product invoice and maintenace asking
     * @param uint  $product_id_  product id
     * @param uint  $quantity_    the quantity to get
     * @param uint  $begin_       the begin page
     * @return the json object
     */
    public static function getProductInvoiceAndMaintAsking($product_id_, $begin_ = 0, $quantity_ = 0)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['GET'], $_REVIEW_CATEGORY['PRODUCT_ASKING'], $_REVIEW_SUB_CATEGORY['INVOICE'],
                    $product_id_, 0, 0, $quantity_, $begin_, "", 0, "", "", "");

        return IReview::sendRequest($cmd, true);
    }

    /**
     * get all transport and pay asking
     * @param uint  $product_id_  product id
     * @param uint  $quantity_    the quantity to get
     * @param uint  $begin_       the begin page
     * @return the json object
     */
    public static function getProductTransAndPayAsking($product_id_, $begin_ = 0, $quantity_ = 0)
    {
        global $_REVIEW_CMD;
        global $_REVIEW_CATEGORY;
        global $_REVIEW_SUB_CATEGORY;
        // 1      2             3                4            5           6      7           8        9      10       11    12
        //cmd=%d&categoryId=%d&subCategoryId=%d&productId=%d&reviewId=%d&uid=%d&quantity=%d&begin=%d&ruid=%s&score=%d&ip=%s&content=%s&title=%s&synFlag=%d
        $cmd = sprintf(REIVEW_REQUEST_TEMPLATE,
                    $_REVIEW_CMD['GET'], $_REVIEW_CATEGORY['PRODUCT_ASKING'], $_REVIEW_SUB_CATEGORY['TRANSPORT'],
                    $product_id_, 0, 0, $quantity_, $begin_, "", 0, "", "", "");

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

        return IReview::checkUserReviewLimit($uid, $_REVIEW_CATEGORY['PRODUCT_ASKING'], 0);
    }
}

?>
