<?php
define('ERROR_INVALID_USER_ID',           400);
define('ERROR_INVALID_PRODUCT_ID',        401);
define('ERROR_INVALID_PAREND_PRODUCT_ID', 402);
define('ERROR_INVALID_ID',                403);
define('ERROR_DUPLICATE',                 404);


define('TYPE_MY_FAVORITE',    1);
define('TYPE_RECENT_HISTORY', 2);
define('MAX_FAVORATE_NUMBER', 100);
define('MAX_RECENT_HISTORY',  100);


class IUserProducts_t
{
    public static $errCode = 0;
    public static $errMsg = '';

    /**
     * Add product id into user favorites
     * @param int $user_id_
     * @param int $product_id_
     * @param int $parent_product_id_
     * @return int
     */
    protected static function _add($user_id_, $type_, $product_id_, $id_ = 0)
    {
        if (!isset($user_id_) || $user_id_ <= 0)
        {
            self::$errCode = ERROR_INVALID_USER_ID;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "user_id($user_id_) is invalid";
            return false;
        }

        if (!isset($product_id_) || $product_id_ <= 0)
        {
            self::$errCode = ERROR_INVALID_PRODUCT_ID;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id($product_id_) is invalid";
            return false;
        }

        // Get the products according userid from IUserProductsTTC
        $products = IUserProductsTTC::get($user_id_, array('type' =>$type_));
        if (false === $products)
        {
            self::$errCode = IUserProductsTTC::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IUserProductsTTC failed]' . IUserProductsTTC::$errMsg;
            return false;
        }
        else if (empty($product))
        {
            // the first check whether exsit in ttc, if exsit then return true
            foreach ($products AS $product)
            {
                if ($product['product_id'] == $product_id_)
                {
                    if (1 === $product['status'])
                    {
                        self::$errCode = ERROR_DUPLICATE;
                        return false;
                    }
                    $ret = IUserProductsTTC::update(array('user_id' => $user_id_, 'status' => 1, 'id' => $id_), array('product_id' => $product_id_, 'type' => $type_));
                    if (false === $ret)
                    {
                        self::$errCode = IUserProductsTTC::$errCode;
                        self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[remove IUserProductsTTC failed]' . IUserProductsTTC::$errMsg;
                        return false;
                    }

                    return true;
                }
            }

            // Adjust the max products quantity for every user according type,
            // if the quantity more than the max, then remove the earliest product
            IMyFavorite::adjustMaxQuantity($user_id_, $type_, $products);

            // Prepare the product info
            $product = array('user_id' => $user_id_,
                             'type' => $type_,
                             'product_id' => $product_id_,
                             'update_time' => time(),
                             'id' => $id_,
                             'status' => 1);

            // Insert user favorite product into ttc cache
            if (false === IUserProductsTTC::insert($product))
            {
                self::$errCode = IUserProductsTTC::$errCode;
                self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[insert IUserProductsTTC failed]' . IUserProductsTTC::$errMsg;
                return false;
            }
        }

        return true;
    }

    /**
     * get product info according to user id and product id
     * @param int $user_id_
     * @param int $type_
     * @param int $product_id_
     * @return int
     */
    protected static function _getAvailable($user_id_, $type_, $product_id_)
    {
        if (!isset($user_id_) || $user_id_ <= 0)
        {
            self::$errCode = ERROR_INVALID_USER_ID;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "user_id($user_id_) is invalid";
            return false;
        }

        if (!isset($product_id_) || $product_id_ <= 0)
        {
            self::$errCode = ERROR_INVALID_USER_ID;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "product_id_($product_id_) is invalid";
            return false;
        }

        // Get the products according userid from IUserProductsTTC
        $product = IUserProductsTTC::get($user_id_, array('product_id' => $product_id_, 'type' => $type_, 'status' => 1));
        if (false === $product)
        {
            self::$errCode = IUserProductsTTC::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IUserProductsTTC failed]' . IUserProductsTTC::$errMsg;
            return false;
        }
        if (!empty($product))
        {
            return false;
        }

        return true;
    }

    /**
     * delete product id from user favorites
     * @param int $user_id_
     * @param int $product_id_
     * @return int
     */
    protected static function _delete($user_id_, $type_, $product_id_)
    {
        if (!isset($user_id_) || $user_id_ <= 0)
        {
            self::$errCode = ERROR_INVALID_USER_ID;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "user_id($user_id_) is invalid";
            return false;
        }

        // Get the products according userid from IUserProductsTTC
        $product = IUserProductsTTC::get($user_id_, array('product_id' => $product_id_, 'type' => $type_));
        if (false === $product)
        {
            self::$errCode = IUserProductsTTC::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IUserProductsTTC failed]' . IUserProductsTTC::$errMsg;
            return false;
        }
        else if (!empty($product))
        {
            if (false === IUserProductsTTC::update(array('user_id' => $user_id_, 'status' => 2), array('product_id' => $product_id_, 'type' => $type_)))
            {
                self::$errCode = IUserProductsTTC::$errCode;
                self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[remove IUserProductsTTC failed]' . IUserProductsTTC::$errMsg;
                return false;
            }
        }

        return true;
    }

    /**
     * Get user products according to user id
     * @param int $user_id_
     * @param int $itemLimit, limit
     * @param int $start
     * @return array(product_id=>array('product_id', 'update_time', 'id'))
     */
    protected static function _getProducts($user_id_, $type_, $itemLimit_ = 0, $start_ = 0)
    {
        if (!isset($user_id_) || $user_id_ <= 0)
        {
            self::$errCode = ERROR_INVALID_USER_ID;
            self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "user_id($user_id_) is invalid";
            return false;
        }

        $products = array();
        // Get the products according userid from IUserProductsTTC
        $items = IUserProductsTTC::get($user_id_,
                                       array('type' => $type_, 'status' => 1), array(),
                                       $itemLimit_,
                                       $start_);
        if (false === $items)
        {
            self::$errCode = IUserProductsTTC::$errCode;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IUserProductsTTC failed]' . IUserProductsTTC::$errMsg;
            return false;
        }
        else if(!empty($items))
        {
            foreach($items AS $item)
            {
               $products[$item['product_id']] = array('product_id' => $item['product_id'],
                                                      'update_time' => $item['update_time'],
                                                      'id' => $item['id']);
            }
        }

        return $products;
    }

    /**
     * Adjust the max product quantity of user in the ttc cache.
     * @param int $user_id_
     * @param array(product_id) $product_ids_ the arry of product ids which need to delete
     * @return int
     */
    private static function adjustMaxQuantity($user_id_, $type_, $products_)
    {
        if (TYPE_MY_FAVORITE == $type_)
        {
            $max = MAX_FAVORATE_NUMBER;
        }
        else if (TYPE_RECENT_HISTORY == $type_)
        {
            $max = MAX_RECENT_HISTORY;
        }
        else
        {
            return;
        }

        // check the quantity whether more than the max value, if more then remove that parts
        if (count($products_) > $max)
        {
            $number = 1;
            // Adjust the max favoriate products quantity for every user,
            // if the quantity more than the max, then remove the earliest product
            foreach ($products_ AS $product)
            {
                if ($number >= $max)
                {
                    if (false === IUserProductsTTC::remove($user_id_, array('type' => $type_, 'product_id' => $product['product_id'])))
                    {
                        self::$errCode = IUserProductsTTC::$errCode;
                        self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[remove IUserProductsTTC failed]' . IUserProductsTTC::$errMsg;
                    }
                }
                $number++;
            }
        }
    }

}

?>