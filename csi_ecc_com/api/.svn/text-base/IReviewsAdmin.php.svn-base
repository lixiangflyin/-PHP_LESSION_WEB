<?php
require_once(ROOT_DIR . 'api/IReview.php');
//require_once(PHPLIB_ROOT . 'inc/constant.inc.php');
//require_once('IScore.php');
//require_once('inc/IProductInfoTTC.php');

/**
 * 评论相关接口，用于后台系统专用，前台勿用！
 * @author mackwang
 *
 */
class IReviewsAdmin extends IReview
{
    /**
     * delete review
     * @param uint $review_id_ review id
     * @param uint $user_id_   user id
     * @param uint $type_   review_type:
     *                      SATISFIED : 1
     *                      GENERAL   : 2
     *                      UNSATISFIED : 3
     *                      DISCUSSION  : 4
     *                      ASK         : 5
     * @return 
     * 失败返回:false
     * 成功返回数据，以/r/n结尾：{"errCode":0,"errMsg":""}\r\n
     * eg:
     *      $returnVal = IReviewsAdmin::deleteReview($product_id_,0,10);
     *      if($returnVal === false){
     *          //返回失败
     *      }
     *      $returnVal = ToolUtil::gbJsonDecode($returnVal);
     *      if($returnVal === "" ){
     *          //空数据
     *      }else{
     *          //数据
     *      }
     */
    public static function deleteReview($product_id_, $review_id_, $user_id_, $type_, $quantity_ = 1)
    {
       return self::setStatus($product_id_, $review_id_, $user_id_, $type_, 'REJECTED', $quantity_);
    }
}

?>
