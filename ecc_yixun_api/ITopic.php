<?php


/**
 * the class of review's reply
 * @author Bill
 *
 */
class ITopic
{
    public static $errCode = 0;
    public static $errMsg = '';

    /**
     * add the product performance
     * @param uint $product_id_  product id
     * @param uint $user_id_     user id
     * @param array(array('category_id', 'score'))
     *             $performance_ product performance info
     * @return true or false
     */
    public static function addProductPerformance($product_id_, $user_id_, $performance_)
    {

    }

    /**
     * get the product's performance vote
     * @param uint $product_id_
     * @return the json object
     */
    public static function getProductPerformance($product_id_)
    {

    }

    /**
     * get the product performance list
     * @param uint $id_ maybe the third class id
     * @return array(array('category_id', 'name'))
     */
    public static function getProductPerformanceList($id_)
    {

    }
}

