<?php
require_once(PHPLIB_ROOT . 'api/IUserProducts.php');
class IRecentHistory extends IUserProducts_t
{
    /**
     * Add product id into user recent history
     * @param int $user_id_
     * @param int $product_id_
     * @param int $parent_product_id_
     * @return int
     */
    static public static function add($user_id_, $product_id_)
    {
        return IRecentHistory::_add($user_id_, TYPE_RECENT_HISTORY, $product_id_);
    }

    /**
     * delete product id from user favorites
     * @param int $user_id_
     * @param int $product_id_
     * @param int $parent_product_id_
     * @return int
     */
    static public static function delete($user_id_, $product_id_)
    {
        return IRecentHistory::_delete($user_id_, TYPE_RECENT_HISTORY, $product_id_);
    }

    /**
     * Get user favorite products according to user id
     * @param int $user_id_
     * @param int $page_, the query page
     * @param int $quantity_, the product quantity of current page
     * @return array(¡®products'=>array('id', 'pid', 'char_id¡¯, 'name', 'price'), quantity, page, total_pages)
     */
    static public function gets($user_id_, $wh_id_ = 1, $quantity_ = 4)
    {
        // if $quantity_ is invalid, then set the default value
        if (0 >= $quantity_)
        {
            $quantity_ = 4;
        }

        $result = array();

        //Get the product ids array(product_id=>array('id', 'pid'))
        $products = self::_getProducts($user_id_, TYPE_RECENT_HISTORY, $quantity_);

        if (!empty($products))
        {
            $product_ids = array();
            foreach ($products AS $id => $info)
            {
                $product_ids[] = $id;
            }

            // get the product name
            $products_info = IProduct::getProductsInfo($product_ids, $wh_id_);
            if($products_info === false){
                self::$errCode = IProduct::$errCode;
                self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IProduct failed]' . IProduct::$errMsg;
                return false;
            }
            foreach ($products_info as $product_info)
            {
                $result[] = array('product_id'     => $product_info['product_id'],
                                  'product_char_id'=> $product_info['product_char_id'],
                                  'id'             => $products[$product_info['product_id']]['id'],
                                  'update_time'    => $products[$product_info['product_id']]['update_time']);
            }
        }

        return $result;
    }
}
?>
