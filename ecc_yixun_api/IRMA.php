<?php
define('RMA_PENDING_DESCRIPTION',    "我们会尽快审核您的信息，请耐心等待。");

$_RMA_REQUST_STATUS_STR = array(
    "UNRECEIVED" => array(
                    "NOT_ONDOOR"        => "我们暂未收到您的商品。请您尽快安排发货，以免影响退换货的处理！",
                    "ONDOOR_ASSIGN"     => "我们已安排快递上门取货，请准备好相关商品！快递方式：易迅快递 快递师傅:%s %d",
                    "ONDOOR_NOT_ASSIGN" => "我们会尽快安排快递上门取货，请您准备好相关商品！快递方式：易迅快递",
                    ),
    "RECEIVED" => array(
                    "CHANGE" => array(
                                "UNSEND" =>"待发货！",
                                "ICSON"  => array(
                                            "SET_CONTACT"    => "已发货！快递方式：易迅快递  快递师傅：%s %d",
                                            "UNSET_CONTACT"  => "已发货！快递方式：易迅快递！ "
                                            ),
                                "SELF_GET" => array(
                                            "SH"             => "已发货！快递方式：客户上门提货（上海）！ ",
                                            "HZ"             => "已发货！快递方式：客户上门提货（杭州）！",
                                            "YZ"             => "已发货！快递方式：客户上门提货（扬州）！",
                                            "SZ"             => "已发货！快递方式：客户上门提货（苏州）！"
                                            ),
                                "OTHER" => array(
                                            "NORMAL"         => "已发货！快递方式：普通快递",
                                            "EMS"            => "已发货！快递方式：邮政EMS"
                                            ),
                    ),
                    "RETURN" => array(
                                "WAIT"    => "待退款！",
                                "PENDING" => "已审核，待付款！",
                                "DONE"    => "退款已汇出，请注意查收！"
                    ),
                    "OTHER" => "我们已收到您的产品，正在处理，请耐心等待",
                  )
);

define('ERR_MSSQL_CONNECT_FAIL',     1000);
define('ERR_MSSQL_TRANSACTION_FAIL', 1001);
define('ERR_MSSQL_EXECUTE_FAIL',     1002);

define('ERR_NULL_PARAM',             1 );
define('ERR_PARAM_RMA_ID',           2 );
define('ERR_PARAM_USER_ID',          3 );
define('ERR_PARAM_COMMENTS',         4 );
define('ERR_PARAM_ORDER_ID',         5 );
define('ERR_PARAM_DESCRIPTION',      6 );
define('ERR_PARAM_PRODUCT_IDS',      7 );
define('ERR_PARAM_CONTACT_INFO',     8 );
define('ERR_CONTACT_ADDRESS',        9 );
define('ERR_CONTACT_AREA_ID',        10);
define('ERR_CONTACT_ZIP',            11);
define('ERR_CONTACT_USER',           12);
define('ERR_CONTACT_PHONE',          13);
define('ERR_PARAM_IS_REVERT_ADDRESS',14);
define('ERR_PARAM_REVERT_INFO',      15);
define('ERR_PARAM_REVERT_ADDRESS',   16);
define('ERR_PARAM_REVERT_AREA_ID',   17);
define('ERR_PARAM_REVERT_ZIP',       18);
define('ERR_PARAM_REVERT_USER',      19);
define('ERR_PARAM_REVERT_PHONE',     20);

class IRMA
{
    public static $errMsg = "";
    public static $errCode = 0;
    private static $_MSDB = false;

    private static function getMSDB($wh_id_ = 1)
    {
        $wh_name = 'ERP_' . $wh_id_;
        self::$_MSDB = config::getMSDB($wh_name);
        if (false === self::$_MSDB)
        {
            self::$errMsg = config::$errMsg;
            self::$errCode = config::$errCode;
        }

        return self::$_MSDB;
    }

    /**
     * @brief  add RMA info into ERP database
     * @param array('order_id', 'user_id',     'contact_info' => array('address', 'area_id', 'zip', 'contact', 'phone',
                                                                       'cellphone, 'can_door_get', 'etake_date', 'etake_time_span', 'door_get_fee'),
     *              'is_revert_address','revert_contact_info' => array('address', 'area_id', 'zip', 'contact', 'phone'),
     *              'description', 'reason', 'product_ids'=>array()) $rma_info_
     */
    public static function addRma($rma_info_, $wh_id_= 1)
    {
        $ret = IRMA::checkRmaInfo($rma_info_);
        if (false === $ret)
        {
            return false;
        }

        $MSDB = self::getMSDB($wh_id_);
        if (false === $MSDB)
        {
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

        $new_rma = array();
        //get a new rma id
        $new_id = IIdGenerator::getNewId('rma_customerrequest_sequence');
        if (false === $new_id || $new_id <= 0)
        {
            self::$errCode = IIdGenerator::$errCode;
            self::$errMsg = IIdGenerator::$errMsg;
            return  false;
        }
        $new_request_id = sprintf("%s%09d", "U", $new_id);
        $order_id = intval(substr($rma_info_['order_id'], -9));

        // assign rma value
        $new_rma['SysNo']           = $new_id;
        $new_rma['SoSysNo']         = $order_id;
        $new_rma['RequestID']       = $new_request_id;
        $new_rma['CustomerSysNo']   = $rma_info_['user_id'];
        $new_rma['Address']         = $MSDB->msEscapeStr($rma_info_['contact_info']['address']);
        $new_rma['Contact']         = $MSDB->msEscapeStr($rma_info_['contact_info']['contact']);
        $new_rma['Phone']           = $rma_info_['contact_info']['phone'];
        $new_rma['AreaSysNo']       = $rma_info_['contact_info']['area_id'];
        $new_rma['Zip']             = $rma_info_['contact_info']['zip'];
        $new_rma['IsRevertAddress'] = $rma_info_['is_revert_address'];
        $new_rma['Description']     = $MSDB->msEscapeStr($rma_info_['description']);
        $new_rma['CellPhone']       = $rma_info_['contact_info']['cellphone'];
        $new_rma['CanDoorGet']      = $rma_info_['contact_info']['can_door_get'];
        $new_rma['EtakeDate']       = $rma_info_['contact_info']['etake_date'];
        $new_rma['EtakeTimeSpan']   = $rma_info_['contact_info']['etake_time_span'];
        $new_rma['DoorGetFee']      = $rma_info_['contact_info']['door_get_fee'];
        if (0 == $rma_info_['is_revert_address'])
        {
            $new_rma['RevertAddress']     = $MSDB->msEscapeStr($rma_info_['revert_contact_info']['address']);
            $new_rma['RevertContact']     = $MSDB->msEscapeStr($rma_info_['revert_contact_info']['contact']);
            $new_rma['RevertContactPhone']= $rma_info_['revert_contact_info']['phone'];
            $new_rma['RevertAreaSysNo']   = $rma_info_['revert_contact_info']['area_id'];
            $new_rma['RevertZip']         = $rma_info_['revert_contact_info']['zip'];
            $new_rma['RevertCellPhone']   = $rma_info_['revert_contact_info']['mobile'];//add 收货联系人手机
        }

        if (1 == $rma_info_['is_revert_address'])
        {
            $sql = "INSERT INTO RMA_CustomerRequest
                    (SysNo,SoSysNo,RequestID,CreateTime,Status,CustomerSysNo,Address,Contact,Phone,AreaSysNo,Zip,IsRevertAddress,Description,
                     CellPhone,CanDoorGet,EtakeDate,EtakeTimeSpan,DoorGetFee)
                    VALUES({$new_rma['SysNo']},{$new_rma['SoSysNo']},'{$new_rma['RequestID']}',GETDATE(),'0','{$new_rma['CustomerSysNo']}',
                    '{$new_rma['Address']}','{$new_rma['Contact']}','{$new_rma['Phone']}','{$new_rma['AreaSysNo']}','{$new_rma['Zip']}',
                    {$new_rma['IsRevertAddress']},'{$new_rma['Description']}', '{$new_rma['CellPhone']}','{$new_rma['CanDoorGet']}',
                    '{$new_rma['EtakeDate']}','{$new_rma['EtakeTimeSpan']}','{$new_rma['DoorGetFee']}')";
        }
        else
        {
            $sql = "INSERT INTO RMA_CustomerRequest
                    (SysNo,SoSysNo,RequestID,CreateTime,Status,CustomerSysNo,Address,Contact,Phone,AreaSysNo,Zip,IsRevertAddress,Description,
                    RevertAddress,RevertContact,RevertContactPhone,RevertCellPhone,RevertAreaSysNo,RevertZip, CellPhone,CanDoorGet,EtakeDate,EtakeTimeSpan,DoorGetFee)
                    VALUES({$new_rma['SysNo']},{$new_rma['SoSysNo']},'{$new_rma['RequestID']}',GETDATE(),'0',{$new_rma['CustomerSysNo']},
                    '{$new_rma['Address']}','{$new_rma['Contact']}','{$new_rma['Phone']}','{$new_rma['AreaSysNo']}','{$new_rma['Zip']}',
                    {$new_rma['IsRevertAddress']},'{$new_rma['Description']}','{$new_rma['RevertAddress']}','{$new_rma['RevertContact']}',
                    '{$new_rma['RevertContactPhone']}', '{$new_rma['RevertCellPhone']}','{$new_rma['RevertAreaSysNo']}', '{$new_rma['RevertZip']}', '{$new_rma['CellPhone']}',
                    '{$new_rma['CanDoorGet']}', '{$new_rma['EtakeDate']}','{$new_rma['EtakeTimeSpan']}','{$new_rma['DoorGetFee']}')";
        }

        $ret = $MSDB->execSql($sql);
        if (false === $ret)
        {
            $sql = "rollback";
            $MSDB->execSql($sql);

            self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
            return  false;
        }

        $rma_item = array();
        $rma_item['CustomerRequestSysNo'] = $new_id;
        $rma_item['Status'] = 1;
        $rma_item['Reason'] = $MSDB->msEscapeStr($rma_info_['reason']);;
        foreach ($rma_info_['product_ids'] AS $product_id)
        {
            $rma_item['ProductSysNo'] = $product_id;
            $sql = $MSDB->getInsertString('RMA_CustomerRequest_Item', $rma_item);;
            $ret = $MSDB->execSql($sql);
            if (false === $ret)
            {
                $sql = "rollback";
                $MSDB->execSql($sql);

                self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
                self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
                return  false;
            }
        }

        $sql = "commit";
        $MSDB->execSql($sql);

        return true;
    }

    /**
     *
     * Check the products in the order whether allow to apply maintenance
     * @param int               $order_id    order id
     * @param array(product_id) $products    products in the order
     * $return array(array(product_id, status)) the pair of product and the RMA status
     */
    public static function getAvaliableOrderProducts($user_id_, $order_id_, $product_ids_, $wh_id_ = 1)
    {
        if (!isset($order_id_) || $order_id_ <= 0)
        {
            self::$errCode = ERR_PARAM_ORDER_ID;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'order id is invalid';

            return false;
        }

        if (!isset($product_ids_) || count($product_ids_) === 0)
        {
            self::$errCode = ERR_PARAM_PRODUCT_IDS;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'product ids is invalid';

            return false;
        }

        $MSDB = self::getMSDB($wh_id_);
        if (false === $MSDB)
        {
            return false;
        }

        $ret = array();
        foreach($product_ids_ AS $product_id)
        {
            $ret[$product_id] = true;
        }

        $ids_str = implode(",", $product_ids_);
        $sql = "select b.SysNo from RMA_CustomerRequest a inner join SO_Master c on a.SOSysNo=c.SysNo
                    inner join RMA_CustomerRequest_Item d  on a.SysNo=d.CustomerRequestSysNo
                    inner join Product b on d.ProductSysNo=b.SysNo
                    where a.CustomerSysNo={$user_id_} and c.SOID='{$order_id_}'
                    and (a.Status=0 or a.Status=1) and d.Status=1 and b.SysNo IN ($ids_str)";
        //$sql = "select top 1* from RMA_CustomerRequest";

        $items = $MSDB->getRows($sql);
        if (false === $items)
        {
            self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;

            return  false;
        }
        else
        {
            foreach ($items AS $item)
            {
                $ret[$item['SysNo']] = false;
            }
        }

        $sql = "select  a.SysNo
                from    SO_Master a with ( nolock )
                        inner join RMA_Request b with ( nolock ) on a.SysNo = b.SOSysNo
                        inner join RMA_Request_Item c with ( nolock ) on b.SysNo = c.RequestSysNo
                        inner join RMA_Register d with ( nolock ) on c.RegisterSysNo = d.SysNo
                        inner join Product e with ( nolock ) on d.ProductSysNo = e.SysNo
                where   ( d.Status = 0
                          or d.Status = 1
                          or d.Status = 3
                        )
                        and a.SOID = '{$order_id_}'
                        and e.SysNo IN ({$ids_str})";

        $items = $MSDB->getRows($sql);
        if (false === $items)
        {
            self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
            return  false;
        }
        else
        {
            foreach ($items AS $item)
            {
                $ret[$item['SysNo']] = false;
            }
        }

        return $ret;
    }

    /**
     * @brief  insert a comments about rma
     * @param array('rma_id', 'user_id', 'comments') $rma_comments_
     */
    public static function addRmaComments($rma_comments_, $wh_id_ = 1)
    {
        $ret = self::checkRmaComments($rma_comments_);
        if (false === $ret)
        {
            return false;
        }

        $MSDB = self::getMSDB($wh_id_);
        if (false === $MSDB)
        {
            return false;
        }

        $new_id = IIdGenerator::getNewId('RMA_CustomerRequestNote_Sequence');
        if (false === $new_id || $new_id <= 0)
        {
            self::$errCode = IIdGenerator::$errCode;
            self::$errMsg = IIdGenerator::$errMsg;
            return  false;
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

        $sql = "INSERT INTO RMA_CustomerRequestNote
                (CustomerRequestSysNo, Content1, Type, Status, CreateUserSysNo, CreateDate, SysNo)
                VALUES('{$rma_comments_['rma_id']}', '{$rma_comments_['comments']}', 1, 0, '{$rma_comments_['user_id']}', GETDATE(), $new_id)";

        $ret = $MSDB->execSql($sql);
        if (false === $ret)
        {
            $sql = "rollback";
            $MSDB->execSql($sql);

            self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
            return  false;
        }

        $sql = "SELECT SysNo FROM RMA_LastCustomerRequestNote WHERE CustomerRequestSysNo = {$rma_comments_['rma_id']}";
        $items = $MSDB->getRows($sql);
        if (false === $items)
        {
            $sql = "rollback";
            $MSDB->execSql($sql);

            self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;

            return  false;
        }
        else
        {
            if (0 == count($items))
            {
                $sql = "INSERT INTO RMA_LastCustomerRequestNote
                        (CustomerRequestSysNo, Type, Status, updateUserSysNo, updateTime, SysNo)
                        VALUES('{$rma_comments_['rma_id']}', 1, 0, '{$rma_comments_['user_id']}', GETDATE(), $new_id)";

                $ret = $MSDB->execSql($sql);
                if (false === $ret)
                {
                    $sql = "rollback";
                    $MSDB->execSql($sql);

                    self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
                    self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
                    return  false;
                }
            }
            else
            {
                $sql = "UPDATE RMA_LastCustomerRequestNote SET
                        Type = 1, Status = 0, updateUserSysNo = '{$rma_comments_['user_id']}',
                        updateTime = GETDATE(), rowModifyDate = GETDATE(), SysNo = $new_id
                        WHERE CustomerRequestSysNo = '{$rma_comments_['rma_id']}'";

                $ret = $MSDB->execSql($sql);
                if (false === $ret)
                {
                    $sql = "rollback";
                    $MSDB->execSql($sql);

                    self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
                    self::$errMsg='执行sql语句失败' . $MSDB->errMsg;;
                    return  false;
                }
            }
        }

        $sql = "commit";
        $MSDB->execSql($sql);

        return true;
    }

    /**
     * @brief  get RMA applies according to user id
     * @param  int $user_id_  user id
     * @param  int $begin_    begin position
     * @param  int $quantity_ applies quantity
     * @return array('rma_id', 'rma_no', 'create_time', 'status_description', 'products' => array('name', 'id', 'product_id', 'char_id'))
     */
    public static function getRmaApplies($user_id_, $begin_, $quantity_, $wh_id_ = 1)
    {
        global $_RMA_CUSTOMER_REQUEST_STATUS;
        $ret = self::checkGetParam($user_id_, $begin_, $quantity_);
        if (false === $ret)
        {
            return false;
        }

        $MSDB = self::getMSDB($wh_id_);
        if (false === $MSDB)
        {
            return false;
        }

        /*$table = "RMA_CustomerRequest";
        $fields = array("SysNo",
                        "RequestID",
                        "CreateTime",
                        "Status",
                        "ReturnDescription",
                        "AuditReason");
        $condition = "CustomerSysNo = {$user_id_} AND Status IN ({$_RMA_CUSTOMER_REQUEST_STATUS['PENDING']},
                      {$_RMA_CUSTOMER_REQUEST_STATUS['APPROVED']}, {$_RMA_CUSTOMER_REQUEST_STATUS['REJECT']}) ORDER BY CreateTime DESC";

        $rma_appies = array();
        $result = $MSDB->getRows2($table, $fields, $condition, $begin_, $quantity_);*/
        //分页处理
		$sql = "select * from ("
					."select SysNo, RequestID, CreateTime, Status, ReturnDescription, AuditReason, "
					."row_number() over (order by CreateTime desc) rn "
					."from RMA_CustomerRequest where CustomerSysNo = {$user_id_} AND Status IN ({$_RMA_CUSTOMER_REQUEST_STATUS['PENDING']},
					{$_RMA_CUSTOMER_REQUEST_STATUS['APPROVED']}, {$_RMA_CUSTOMER_REQUEST_STATUS['REJECT']}) "
				.") tmpres "
				."where rn > ($begin_ * $quantity_) and rn <= (($begin_ + 1) * $quantity_) ";
		$rma_appies = array();
		$result = $MSDB->getRows($sql);
        if (false === $result)
        {
            self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
            return  false;
        }
        else
        {
            foreach ($result AS $rma)
            {
                $item = array();
                $item['rma_id'] = $rma['SysNo'];
                $item['rma_no'] = $rma['RequestID'];
                $item['create_time'] = $rma['CreateTime'];
                $item['notes'] = self::getRmaNotes($item['rma_id'], 0, 0, $wh_id_);
                switch ($rma['Status'])
                {
                    case $_RMA_CUSTOMER_REQUEST_STATUS['PENDING']:
                        $item['status_description'] = RMA_PENDING_DESCRIPTION;
                        break;
                    case $_RMA_CUSTOMER_REQUEST_STATUS['APPROVED']:
                        $item['status_description'] = $rma['ReturnDescription'];
                        break;
                    case $_RMA_CUSTOMER_REQUEST_STATUS['REJECT']:
                        $item['status_description'] = $rma['AuditReason'];
                        break;
                }

                $sql = "SELECT rma.SysNo as rma_sysno, product.SysNo, product.ProductTypeMasterID, product.ProductID, product.ProductName
                        FROM RMA_CustomerRequest_Item AS rma, dbo.Product AS product
                        WHERE rma.CustomerRequestSysNo = {$item['rma_id']} AND product.SysNo = rma.ProductSysNo";

                $product_ids = $MSDB->getRows($sql);
                if ($product_ids)
                {
                    foreach ($product_ids AS $product_id)
                    {
                        $products = array();
                        $products['name'] = $product_id['ProductName'];
                        $products['id'] = $product_id['SysNo'];
                        $products['parent_id'] = $product_id['ProductTypeMasterID'];
                        $products['char_id'] = $product_id['ProductID'];

						$item['rma_sysno'] = $product_id['rma_sysno'];
                        $item['products'][] = $products;
                    }
                }
                else
                {
					$item['rma_sysno'] = "";
                    $item['products'] = array();
                }
                $rma_appies[] = $item;
            }
        }

        return $rma_appies;
    }

    /**
     * @brief  get RMA note according to rma id
     * @param  int $rma_id_  rma id
     * @return array('notes', 'create_time', 'is_icson')
     */
    public static function getRmaNotes($rma_id_, $begin_ = 0, $quantity_ = 0, $wh_id_ = 1)
    {
        global $_RMA_NOTES_STATUS;
        if (!isset($rma_id_) || $rma_id_ <= 0)
        {
            self::$errCode = ERR_PARAM_USER_ID;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'rma id is invalid';

            return false;
        }

        $MSDB = self::getMSDB($wh_id_);
        if (false === $MSDB)
        {
            return false;
        }

        $table = "RMA_CustomerRequestNote";
        $fields = array("Content1, Type, CreateDate");
        $condition = "CustomerRequestSysNo = {$rma_id_} ORDER BY CreateDate";

        $rma_notes = array();
        $result = $MSDB->getRows2($table, $fields, $condition, $begin_, $quantity_);
        if (false === $result)
        {
            self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
            return  false;
        }
        else
        {
            foreach ($result AS $rma)
            {
                $item = array();
                $item['notes'] = $rma['Content1'];
                $item['create_time'] = $rma['CreateDate'];
                $item['is_icson'] = ($_RMA_NOTES_STATUS['ICSON'] == $rma['Type']) ? true : false;
                $rma_notes[] = $item;
            }
        }

        return $rma_notes;
    }

    /**
     * @brief  get RMA request according to user id
     * @param  int $user_id_  user id
     * @param  int $begin_    begin position
     * @param  int $quantity_ applies quantity
     * @return array('request_no', 'receive_time', 'status_description', 'products' => array('name', 'id', 'parent_id', 'char_id'))
     */
    public static function getRmaRequest($user_id_, $begin_, $quantity_, $wh_id_ = 1)
    {
        $ret = self::checkGetParam($user_id_, $begin_, $quantity_);
        if (false === $ret)
        {
            return false;
        }

        $MSDB = self::getMSDB($wh_id_);
        if (false === $MSDB)
        {
            return false;
        }

        $sql = "SELECT * FROM (
				SELECT *, ROW_NUMBER() OVER (ORDER BY re_createtime DESC) AS rn
				FROM (
        			SELECT DISTINCT RMA_Register_Log.RegisterSysNo as LogRegisterSysNo,
        				Product.ProductName,
                        Product.ProductID,
                        product.ProductTypeMasterID,
                        Product.SysNo as ProductSysNo,
                        RMA_Request.RecvTime as RMARecvTime,
                        RMA_Request.SysNo as RequestSysno,
                        RMA_Request.RequestID as rma_RequestID,
                        RMA_Request.SoSysNo as OrderId,
                        RMA_Register.RevertStatus,
                        RMA_Register.RefundStatus,
                        RMA_Request.CanDoorGet,
                        RMA_Request.CreateTime as re_createtime,
                        RMA_CustomerRequest.RequestID as rma_CustomerrequestID
                  FROM  RMA_Register (NOLOCK)
                  INNER JOIN Product (NOLOCK) on Product.sysno = RMA_Register.ProductSysNo
                  INNER JOIN RMA_Request_Item (NOLOCK) on RMA_Register.SysNo = RMA_Request_Item.RegisterSysNo
                  INNER JOIN RMA_Request (NOLOCK) on RMA_Request_Item.RequestSysNo = RMA_Request.SysNo
                  INNER JOIN RMA_CustomerRequest (NOLOCK) on RMA_CustomerRequest.SOSysNo = RMA_Request.SOSysNo
                  INNER JOIN RMA_Register_Log (NOLOCK) on RMA_Register.sysno = RMA_Register_Log.RegisterSysNo
                  LEFT JOIN SO_Master with ( nolock ) ON RMA_Request.SOSysNo = SO_Master.SysNo
                  WHERE  RMA_Request.Status <> -1
                  AND SO_Master.CustomerSysNo = {$user_id_})
                  AS TEMP
                )
			AS t
                WHERE rn > ($begin_ * $quantity_) AND rn <= (($begin_ + 1) * $quantity_)
                ORDER BY re_createtime DESC";
        $rma_request = array();
        $result = $MSDB->getRows($sql);
        if (false === $result)
        {
            self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
            return  false;
        }
        else
        {
            foreach ($result AS $rma)
            {
                $item = array();
                $item['request_no']            = $rma['RequestSysno'];
                $item['order_id']              = $rma['OrderId'];
                $item['receive_time']          = (NULL === $rma['RMARecvTime']) ? "" : $rma['RMARecvTime'];
                //$item['status_description']    = self::getRmaReqestStatus($rma);//以前展示状态的方法
                $item['status_description']    = self::getRmaReqestStatus_new($wh_id_, $rma['LogRegisterSysNo']);//以前展示状态的方法
                $item['products']['name']      = $rma['ProductName'];
                $item['products']['id']        = $rma['ProductSysNo'];
                $item['products']['parent_id'] = $rma['ProductTypeMasterID'];
                $item['products']['char_id']   = $rma['ProductID'];
				$item['LogRegisterSysNo']      = $rma['LogRegisterSysNo'];
				$item['rma_RequestID']         = $rma['rma_RequestID'];
				$item['rma_CustomerrequestID'] = $rma['rma_CustomerrequestID'];

                $rma_request[] = $item;
            }
        }

        return $rma_request;
    }

    private static function getRmaReqestStatus($rma_)
    {
        $description ="";
        global $_RMA_REQUST_STATUS_STR;

        if (NULL === $rma_['RMARecvTime'])
        {
            if (1 === $rma_['CanDoorGet'])
            {
                if (NULL === $rma_['FreightUserSysNo'])
                {
                    $description = $_RMA_REQUST_STATUS_STR['UNRECEIVED']['ONDOOR_NOT_ASSIGN'];
                }
                else
                {
                    $description = sprintf($_RMA_REQUST_STATUS_STR['UNRECEIVED']['ONDOOR_ASSIGN'], $rma_['UserName'], $rma_['Phone']);
                }
            }
            else
            {
                $description = $_RMA_REQUST_STATUS_STR['UNRECEIVED']['NOT_ONDOOR'];
            }
        }
        else
        {
            if (22 === $rma_['ShipType'])
            {
                if (NULL === $rma_['SetDeliveryManTime'])
                {
                    $description = $_RMA_REQUST_STATUS_STR['RECEIVED']['CHANGE']['ICSON']['UNSET_CONTACT'];
                }
                else
                {
                    $description = sprintf($_RMA_REQUST_STATUS_STR['RECEIVED']['CHANGE']['ICSON']['SET_CONTACT'], $rma_['UserName'], $rma_['Phone']);
                }
            }
            else if (7 === $rma_['ShipType'])
            {
                $description = $_RMA_REQUST_STATUS_STR['RECEIVED']['CHANGE']['OTHER']['NORMAL'];
            }
            else if (2 === $rma_['ShipType'])
            {
                $description = $_RMA_REQUST_STATUS_STR['RECEIVED']['CHANGE']['OTHER']['EMS'];
            }
            else if (0 === $rma_['RevertStatus'])
            {
                $description = $_RMA_REQUST_STATUS_STR['RECEIVED']['CHANGE']['UNSEND'];
            }
            else if (2 === $rma_['RefundStatus'])
            {
                $description = $_RMA_REQUST_STATUS_STR['RECEIVED']['RETURN']['DONE'];
            }
            else if (0 === $rma_['RefundStatus'])
            {
                $description = $_RMA_REQUST_STATUS_STR['RECEIVED']['RETURN']['WAIT'];
            }
            else if (1 === $rma_['RefundStatus'])
            {
                $description = $_RMA_REQUST_STATUS_STR['RECEIVED']['RETURN']['PENDING'];
            }
            else
            {
                $description = $_RMA_REQUST_STATUS_STR['RECEIVED']['OTHER'];
            }
        }

        return $description;
    }

    private static function checkGetParam($user_id_, $begin_, $quantity_)
    {
        if (!isset($user_id_) || $user_id_ <= 0)
        {
            self::$errCode = ERR_PARAM_USER_ID;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'user id is invalid';

            return false;
        }

        if (!isset($begin_) || !is_int($begin_ ))
        {
            self::$errCode = ERR_PARAM_USER_ID;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'begin is invalid';

            return false;
        }

        if (!isset($quantity_) || !is_int($quantity_))
        {
            self::$errCode = ERR_PARAM_USER_ID;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'quantity is invalid';

            return false;
        }
    }

    /**
     * @brief  check the comments about rma
     * @param array('rma_id', 'user_id', 'comments') $rma_comments_
     */
    private static function checkRmaComments($rma_comments_)
    {
        if (!isset($rma_comments_))
        {
            self::$errCode = ERR_NULL_PARAM;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'rma comments is null';

            return false;
        }

        if (!isset($rma_comments_['rma_id']) || $rma_comments_['rma_id'] <= 0)
        {
            self::$errCode = ERR_PARAM_RMA_ID;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'rma id is invalid';

            return false;
        }

        if (!isset($rma_comments_['user_id']) || $rma_comments_['user_id'] <= 0)
        {
            self::$errCode = ERR_PARAM_USER_ID;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'user id is invalid';

            return false;
        }

        if (!isset($rma_comments_['comments']))
        {
            self::$errCode = ERR_PARAM_COMMENTS;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'comments is invalid';

            return false;
        }
    }

    /**
     * @brief  check RMA info
     * @param array('order_id', 'user_id',     'contact_info' => array('address', 'area_id', 'zip', 'contact', 'phone')
     *              'is_revert_address','revert_contact_info' => array('address', 'area_id', 'zip', 'contact', 'phone'),
     *              'description', 'product_ids'=>array()) $rma_info_
     */
    private static function checkRmaInfo($rma_info_)
    {
        if (!isset($rma_info_))
        {
            self::$errCode = ERR_NULL_PARAM;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'rmb_info is null';

            return false;
        }

        if (!isset($rma_info_['order_id']) || $rma_info_['order_id'] <= 0)
        {
            self::$errCode = ERR_PARAM_ORDER_ID;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'order id is invalid';

            return false;
        }

        if (!isset($rma_info_['user_id']) || $rma_info_['user_id'] <= 0)
        {
            self::$errCode = ERR_PARAM_USER_ID;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'user id is invalid';

            return false;
        }

        if (!isset($rma_info_['description']))
        {
            self::$errCode = ERR_PARAM_DESCRIPTION;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'description is invalid';

            return false;
        }

        if (!isset($rma_info_['product_ids']) || count($rma_info_['product_ids']) == 0)
        {
            self::$errCode = ERR_PARAM_PRODUCT_IDS;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'product ids is invalid';

            return false;
        }

        if (!isset($rma_info_['contact_info']) || count($rma_info_['contact_info']) == 0)
        {
            self::$errCode = ERR_PARAM_CONTACT_INFO;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'contact info is invalid';

            return false;
        }

        if (!isset($rma_info_['contact_info']['address']))
        {
            self::$errCode = ERR_CONTACT_ADDRESS;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'address is invalid';

            return false;
        }

        if (!isset($rma_info_['contact_info']['area_id']) || $rma_info_['contact_info']['area_id'] <= 0)
        {
            self::$errCode = ERR_CONTACT_AREA_ID;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'area_id is invalid';

            return false;
        }

        if (!isset($rma_info_['contact_info']['zip']))
        {
            self::$errCode = ERR_CONTACT_ZIP;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'zip is invalid';

            return false;
        }

        if (!isset($rma_info_['contact_info']['contact']))
        {
            self::$errCode = ERR_CONTACT_USER;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'contact is invalid';

            return false;
        }

        if (!isset($rma_info_['contact_info']['phone']))
        {
            self::$errCode = ERR_CONTACT_PHONE;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'phone is invalid';

            return false;
        }

        if (!isset($rma_info_['is_revert_address']) || $rma_info_['is_revert_address'] < 0 || $rma_info_['is_revert_address'] > 1)
        {
            self::$errCode = ERR_PARAM_IS_REVERT_ADDRESS;
            self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'is_revert_address is invalid';

            return false;
        }

        if (0 == $rma_info_['is_revert_address'])
        {
            if (!isset($rma_info_['revert_contact_info']) || count($rma_info_['revert_contact_info']) == 0)
            {
                self::$errCode = ERR_PARAM_REVERT_INFO;
                self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'revert contact info is invalid';

                return false;
            }

            if (!isset($rma_info_['revert_contact_info']['address']))
            {
                self::$errCode = ERR_PARAM_REVERT_ADDRESS;
                self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'revert address is invalid';

                return false;
            }

            if (!isset($rma_info_['revert_contact_info']['area_id']) || $rma_info_['revert_contact_info']['area_id'] <= 0)
            {
                self::$errCode = ERR_PARAM_REVERT_AREA_ID;
                self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'revert area_id is invalid';

                return false;
            }

            if (!isset($rma_info_['revert_contact_info']['zip']))
            {
                self::$errCode = ERR_PARAM_REVERT_ZIP;
                self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'revert zip is invalid';

                return false;
            }

            if (!isset($rma_info_['revert_contact_info']['contact']))
            {
                self::$errCode = ERR_PARAM_REVERT_USER;
                self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'revert contact is invalid';

                return false;
            }

            if (!isset($rma_info_['revert_contact_info']['phone']))
            {
                self::$errCode = ERR_PARAM_REVERT_PHONE;
                self::$errMsg =  basename(__FILE__, '.php') . " |" . __LINE__ . 'revert phone is invalid';

                return false;
            }
        }
    }

    /**
     * add by allenzhou 2011-12-14
     * 获取当前用户所在站点在线报修总条数
     * @param unknown_type $uid 用户ID
     * @param unknown_type $whId 分站ID
     * return 总条数
     */
    public static function getRmaAppliesCount($uid, $whId){
		global $_RMA_CUSTOMER_REQUEST_STATUS;
		$uid -= 0;
		$MSDB = self::getMSDB($whId);
		if (false === $MSDB)
		{
			return false;
		}

		$sql = "select count(SysNo) as rma_count from RMA_CustomerRequest where CustomerSysNo = {$uid} AND Status IN ({$_RMA_CUSTOMER_REQUEST_STATUS['PENDING']},
					{$_RMA_CUSTOMER_REQUEST_STATUS['APPROVED']}, {$_RMA_CUSTOMER_REQUEST_STATUS['REJECT']})";
		$count = $MSDB->getRows($sql);
		if($count === false || !is_array($count)){
			self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
			return false;
		}
		return $count;
    }

    /**
     * add by allenzhou 2011-12-15
     * 获取相应申请单的处理流水
     * @param unknown_type $whId 分站ID
     * @param unknown_type sysNO 处理单号
     */
    public static function getRmaRegisterLog($whId, $RegisterSysNo){
    	$MSDB = self::getMSDB($whId);
		if (false === $MSDB)
		{
			return false;
		}

		$sql = "SELECT SysNo, RegisterSysNo, SOID, ProductSysNo, ProductName, Status,
				CreateUserSysNo, CreateTime,DATEDIFF(second,'1970-01-01 08:00:00', CreateTime) AS time_span,
				Description, rowCreateDate, rowModifyDate
				FROM RMA_Register_Log
				WHERE RegisterSysNo = '{$RegisterSysNo}'
				ORDER BY CreateTime ASC";
		$result = $MSDB->getRows($sql);
		if($result === false || !is_array($result)){
			self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
			return false;
		}
    	if(isset($result) && (empty($result) || count($result) <= 0)){
			self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
			self::$errMsg='RMA_Register_Log 表查询记录为空' . $MSDB->errMsg;
//			$sql = "select rowCreateDate from RMA_Register where sysno ='{$RegisterSysNo}'";
//			$empty_time = $MSDB->getRows($sql);
			$logs[] = array(
					'time' => '',
					'content' => '待处理',
				);
		}

		if(!empty($result) || count($result) > 0){
			foreach ($result as &$v){
				$logs[] = array(
					'time' => date('Y-m-d H:i:s', $v['time_span']),
					'content' => $v['Description'],
				 );
			}
		}

		return $logs;
    }

    /**
     * add by allenzhou 2011-12-15
     * 获取相应申请单流水总记录数
     * @param unknown_type $uid
     * @param unknown_type $whId
     */
    public static function getRmaRegisterLogCount($uid, $whId){
		$MSDB = self::getMSDB($whId);
		if (false === $MSDB)
		{
			return false;
		}
		 $sql = "SELECT DISTINCT RMA_Register_Log.RegisterSysNo as LogRegisterSysNo,
		 				Product.ProductName,
                        Product.ProductID,
                        product.ProductTypeMasterID,
                        Product.SysNo as ProductSysNo,
                        RMA_Request.RecvTime as RMARecvTime,
                        RMA_Request.SysNo as RequestSysno,
                        RMA_Request.RequestID as rma_RequestID,
                        RMA_Request.SoSysNo as OrderId,
                        RMA_Register.RevertStatus,
                        RMA_Register.RefundStatus,
                        RMA_Request.CanDoorGet,
                        RMA_Request.CreateTime as re_createtime,
                        RMA_CustomerRequest.RequestID as rma_CustomerrequestID
                  FROM  RMA_Register (NOLOCK)
                  INNER JOIN Product (NOLOCK) on Product.sysno = RMA_Register.ProductSysNo
                  INNER JOIN RMA_Request_Item (NOLOCK) on RMA_Register.SysNo = RMA_Request_Item.RegisterSysNo
                  INNER JOIN RMA_Request (NOLOCK) on RMA_Request_Item.RequestSysNo = RMA_Request.SysNo
                  INNER JOIN RMA_CustomerRequest (NOLOCK) on RMA_CustomerRequest.SOSysNo = RMA_Request.SOSysNo
                  INNER JOIN RMA_Register_Log (NOLOCK) on RMA_Register.sysno = RMA_Register_Log.RegisterSysNo
                  LEFT JOIN SO_Master with ( nolock ) ON RMA_Request.SOSysNo = SO_Master.SysNo
                  WHERE RMA_Request.Status <> -1
                  AND SO_Master.CustomerSysNo = {$uid}";

    	$result = $MSDB->getRows($sql);
		if($result === false || !is_array($result)){
			self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
			return false;
		}
		$count= count($result);
		return $count;
    }


    /**
     * add by allenzhou 2012-01-05
     * 获取处理查询最终状态
     * @param int $whId
     * @param int $RegisterSysNo
     */
    public static function getRmaReqestStatus_new($whId, $RegisterSysNo){
    	global $_myrepairLogState;
		$MSDB = self::getMSDB($whId);
		if (false === $MSDB)
		{
			return false;
		}

		$sql = "SELECT top 1 status,Description FROM RMA_Register_Log
				WHERE RegisterSysNo = '{$RegisterSysNo}'
				ORDER BY CreateTime DESC";

		$result = $MSDB->getRows($sql);
		if($result === false || !is_array($result)){
			self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
            self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
			return false;
		}
    	if(isset($result) && (empty($result) || count($result) <= 0)){
			self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
			self::$errMsg='RMA_Register_Log 表查询记录为空' . $MSDB->errMsg;
			$des_status = '待处理';
		}
		//处理状态
		foreach ($result as $rs){
			$des_status = isset($_myrepairLogState[$rs['status']]) ? $_myrepairLogState[$rs['status']] : '';
		}
		return $des_status;
	}

	/**
	 *	add by allenzhou 2012-01-09
	 * 获取RMA_CustomerRequest用户在线申请单填写信息
	 * @param $ram_id
	 * @param $whid
	 */
	public static function getCustomerRequest_info($request_id, $whId){
		$MSDB = self::getMSDB($whId);
		if (false === $MSDB)
		{
			return false;
		}

		$request_array = array();
		$sql = "SELECT DISTINCT a.SysNo, a.SOSysNo, a.RequestID, a.CreateTime, a.CustomerSysNo, a.ProductSysNo,
				a.RequestType, a.RefundType, a.CanDoorGet, a.Address, a.Contact, a.Phone, a.RecvTime,
				a.BankUserName, a.BankACCNo, a.Note, a.Status, a.ETakeDate, a.ETakeTimeSpan, a.AreaSysNo,
				a.Zip, a.IsRevertAddress, a.RevertAddress, a.RevertAreaSysNo, a.RevertZip, a.RevertContact,
				a.RevertContactPhone, a.Description, a.AuditReason, a.DoorGetFee, a.CustomerSendTime, Memo,
				a.UnReturn, a.ReturnDescription, a.AuditTime, a.AuditUserSysNo, a.ReceiveType, a.RevertCellPhone,
				a.rowCreateDate, a.rowModifyDate, a.CellPhone,b.Reason as rma_Requestreason, b.ProductSysNo as rma_CustomerProductSysNo
				FROM RMA_CustomerRequest a
				INNER JOIN RMA_CustomerRequest_Item b ON a.SysNo = b.CustomerRequestSysNo
				WHERE a.RequestID = '{$request_id}'";

		$result = $MSDB->getRows($sql);
		if($result === false || !is_array($result)){
			self::$errCode = ERR_MSSQL_EXECUTE_FAIL;
			self::$errMsg='执行sql语句失败' . $MSDB->errMsg;
			return false;
		}else{
			foreach ($result as $rs){
				$item = array();
				$item['contact_info_requestreason']		=	$rs['rma_Requestreason'];//报修/退换货原因(根据商品来,取自RMA_CustomerRequest_Item表)
				$item['contact_info_description']		=	$rs['Description'];//报修/退换货原因描述
				$item['contact_info_etakedate']			=	$rs['ETakeDate'];//取货日期
				$item['contact_info_etaketimespan']		=	$rs['ETakeTimeSpan'];//取货时间段
				$item['contact_info_doorgetfee']		=	$rs['DoorGetFee'];//取货费用
				$item['contact_info_contact']			=	$rs['Contact'];//取货联系人
				$item['contact_info_phone']				=	$rs['Phone'];//取货联系电话
				$item['contact_info_cellPhone']			=	$rs['CellPhone'];//取货联系手机
				$item['contact_info_address']			=	$rs['Address'];//取货地址
				$item['contact_info_zip']				=	$rs['Zip'];//取货邮编
				$item['contact_info_isrevertaddress']	=	$rs['IsRevertAddress'];////是否与取货地址相同 0自定义;1相同
				$item['contact_info_revertcontact']		=	$rs['RevertContact'];//收货联系人
				$item['contact_info_revertcontactphone']=	$rs['RevertContactPhone'];//收货联系电话
				$item['contact_info_revertcontactcellphone']=$rs['RevertCellPhone'];//收货联系手机
				$item['contact_info_revertaddress']		=	$rs['RevertAddress'];//收货地址
				$item['contact_info_revertzip']			=	$rs['RevertZip'];//收货邮编
				$item['contact_info_rma_productsysno']	=	$rs['rma_CustomerProductSysNo'];//商品ID
				$item['contact_info_candoorget']		=	$rs['CanDoorGet'];//是否上门取件 1:是,0否
				$request_array[] = $item;
			}
		}
		 return $request_array;
	}
}
?>