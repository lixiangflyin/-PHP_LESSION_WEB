<?php
require_once(PHPLIB_ROOT . 'api/IUserProducts.php');
define('ERR_MSSQL_CONNECT_FAIL',     1000);
define('ERR_MSSQL_TRANSACTION_FAIL', 1001);
define('ERR_MSSQL_EXECUTE_FAIL',     1002);

class IMyFavorite extends IUserProducts_t
{
    /**
     * Add product id into user favorites
     * @param int $user_id_
     * @param int $product_id_
     * @param int $parent_product_id_
     * @return int
     */
    public static function add($user_id_, $product_id_)
    {
        $ret = self::_getAvailable($user_id_, TYPE_MY_FAVORITE, $product_id_);
        if ($ret === false)
        {
            self::$errCode = ERROR_DUPLICATE;
            return false;
        }

        //get a new favorator id
        $new_id = IIdGenerator::getNewId('WishList_Sequence');
        if (false === $new_id || $new_id <= 0)
        {
            self::$errCode = IIdGenerator::$errCode;
            self::$errMsg = IIdGenerator::$errMsg;
            return  false;
        }

        self::synAdd($user_id_, $product_id_, $new_id);
        $ret = IMyFavorite::_add($user_id_, TYPE_MY_FAVORITE, $product_id_, $new_id);

        return $ret;
    }

    /**
     * delete product id from user favorites
     * @param int $user_id_
     * @param int $product_id_
     * @param int $id_
     * @return int
     */
    public static function delete($user_id_, $product_id_, $id_)
    {
        self::synDel($id_, $user_id_);
        $ret = IMyFavorite::_delete($user_id_, TYPE_MY_FAVORITE, $product_id_);

        return $ret;
    }

    /**
     * Get user favorite products according to user id
     * @param int $user_id_
     * @param int $page_, the query page
     * @param int $quantity_, the product quantity of current page
     * @return array(‘products'=>array('id', 'product_id', 'product_char_id’, 'name', 'price', 'update_time'))
     */
    static public function gets($user_id_, $wh_id_, $page_ = 1, $quantity_ = 4)
    {
        // if the $page_ is invalid, then set the default value
        if (0 >= $page_)
        {
            $page_ = 1;
        }

        // if $quantity_ is invalid, then set the default value
        if (0 >= $quantity_)
        {
            $quantity_ = 4;
        }

        $result = array();
        //Get the product ids array('product_id'=>array('product_id', 'update_time', 'id'))
        $products = self::_getProducts($user_id_, TYPE_MY_FAVORITE, $quantity_, ($page_-1)*$quantity_);

        if (!empty($products))
        {
            $product_ids = array();
            foreach ($products AS $id => $info)
            {
                $product_ids[] = $id;
            }

            // get the product name
            $products_info = IProduct::getProductsInfo($product_ids, $wh_id_, true);
            if($products_info === false){
                self::$errCode = IProduct::$errCode;
                self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IProduct failed]' . IProduct::$errMsg;
                return false;
            }

            foreach ($products_info as $product_info)
            {
                // The sale price
                $price = $product_info['price'] + $product_info['cash_back'];
                // the return value must be have price and name.
                if (!empty($price) && !empty($product_info['name']))
                {
                    $result[] = array('product_id'      => $product_info['product_id'],
                                      'product_char_id' => $product_info['product_char_id'],
                                      'name'            => $product_info['name'],
                                      'price'           => $product_info['price'],
                                      'show_price'      => $product_info['show_price'],
                                      'market_price'    => $product_info['market_price'],
                                      'promotion_word'  => $product_info['promotion_word'],
									  'flag'  			=> $product_info['flag'],
                                      'id'              => $products[$product_info['product_id']]['id'],
                                      'update_time'     => $products[$product_info['product_id']]['update_time']);
                }
            }
        }

        return $result;
    }

    static public function getCount($user_id_)
    {
        $products = IMyFavorite::_getProducts($user_id_, TYPE_MY_FAVORITE, 0, 0);
        $result = array();
        if (!empty($products))
        {
            $product_ids = array();
            foreach ($products AS $id => $info)
            {
                $product_ids[] = $id;
            }

			$whId = IUser::getSiteId();
            // get the product name
            $products_info = IProduct::getProductsInfo($product_ids, $whId, true);
            if($products_info === false){
                self::$errCode = IProduct::$errCode;
                self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . '[get IProduct failed]' . IProduct::$errMsg;
            }

            foreach ($products_info as $product_info)
            {
                // The sale price
                $price = $product_info['price'] + $product_info['cash_back'];
                // the return value must be have price and name.
                if (!empty($price) && !empty($product_info['name']))
                {
                    $result[] = array('product_id' => $product_info['product_id']);
                }
            }
        }

        return empty($result) ?  0 : count($result);
    }

    static public function synAdd($user_id_, $product_id_, $id_)
    {
        $MSDB = config::getMSDB('ERP_1');
        if (false === $MSDB)
        {
            self::$errCode = ERR_MSSQL_CONNECT_FAIL;
            self::$errMsg  = 'connect to msserveer failed[]'.$MSDB->errMsg;
            return false;
        }

        $sql = "INSERT INTO dbo.WishList
                (SysNo, CustomerSysNo, ProductSysNo, CreateTime, rowCreateDate) VALUES (
                {$id_}, {$user_id_}, {$product_id_}, GETDATE(), GETDATE())";

        $ret = $MSDB->execSql($sql);
        if (false === $ret)
        {
            self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
            return  false;
        }

        return true;
    }

    static public function synDel($id_, $user_id_)
    {
        $MSDB = config::getMSDB('ERP_1');
        if (false === $MSDB)
        {
            self::$errCode = ERR_MSSQL_CONNECT_FAIL;
            self::$errMsg  = 'connect to msserveer failed[]'.$MSDB->errMsg;
            return false;
        }

        // start transaction
        $sql = "begin transaction";
        $ret = $MSDB->execSql($sql);
        if (false === $ret)
        {
            self::$errCode = ERR_MSSQL_TRANSACTION_FAIL;
            self::$errMsg='开启mysql事务失败'.$MSDB->errMsg;
            return  false;
        }

        $sql = "DELETE FROM dbo.WishList WHERE SysNo = {$id_}";

        $ret = $MSDB->execSql($sql);
        if (false === $ret)
        {
            $sql = "rollback";
            $MSDB->execSql($sql);

            self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
            return  false;
        }

        $sql = "INSERT INTO wishlist_delete (sysNo, rowCreateDate, CustomerSysNo) VALUES ({$id_}, GETDATE(), {$user_id_})";

        $ret = $MSDB->execSql($sql);
        if (false === $ret)
        {
            $sql = "rollback";
            $MSDB->execSql($sql);

            self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
            return  false;
        }

        $sql = "commit";
        $MSDB->execSql($sql);

        return true;
    }
}
?>