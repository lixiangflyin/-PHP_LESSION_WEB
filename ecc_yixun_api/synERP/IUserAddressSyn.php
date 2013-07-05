<?php
require_once('MSSQL.php');
require_once('TTC.php');
require_once('Logger.php');
require_once('ToolUtil.php');
require_once('ISyncLog.php');

class IUserAddressSyn
{
    public static $errMsg = "";
    public static $errCode = 0;

    private static $WEB_ERP_PAIR_ADDRESS = array(
					    'uid'        => 'CustomerSysNo',
					    'name'       => 'Name',
					    'workplace'  => 'Brief',
					    'mobile'     => 'CellPhone',
					    'phone'      => 'Phone',
					    'fax'        => 'Fax',
					    'zipcode'    => 'Zip',
					    'district'   => 'AreaSysNo',
					    'address'    => 'Address',
					    'updatetime' => 'rowModifyDate',
					);

    /**
     * Insert the user info into ERP
     */
    public static function insert($item_)
    {
        $ret   = true;
        $sql = "SELECT CustomerSysNo FROM Customer_Address WHERE sysNo = {$item_['aid']}";
        $MSSQL = Config::getMSDB('Customer');
        if (false === $MSSQL)
        {
            self::$errCode = $MSSQL->errCode;
            self::$errMsg = $MSSQL->errMsg;
            Logger::err('connect to msserveer failed[]' . $MSSQL->errMsg);
            ISyncLog::saveSyncLog($item_['uid'],4,$item_['aid']);
            return false;
        }

        $result = $MSSQL->getRows($sql);
        if (false === $result)
        {
            self::$errCode = $MSSQL->errCode;
            self::$errMsg = $MSSQL->errMsg;
            Logger::err("get  user_id({$item_['uid']}) from sql fails " . $MSSQL->errMsg);
            $ret = false;
        }
        else if (0 == count($result))
        {
            $data['sysNo'] = $item_['aid'];
            foreach (self::$WEB_ERP_PAIR_ADDRESS AS $web => $erp)
            {
                if (isset($item_[$web]))
                {
                    $data[$erp] = self::translate($web, $item_, $MSSQL);
                }
            }
            if (isset($data['Name']))
            {
                $data['Contact'] = $data['Name'];
            }
            if (isset($data['AreaSysNo']))
            {
                $area = ToolUtil::getLocInfo($data['AreaSysNo']);
                if (false !== $area)
                {
                    $data['AreaName'] = $MSSQL->msEscapeStr($area['full_name']);
                }
            }
            $data['rowCreateDate'] = $data['rowModifyDate'];
            $data['UpdateTime'] = $data['rowModifyDate'];
            $data['isDefault'] = -1;

            $ret = $MSSQL->insert("Customer_Address", $data);
            if (false === $ret)
            {
                self::$errCode = $MSSQL->errCode;
                self::$errMsg = $MSSQL->errMsg;
                Logger::err("insert address id({$item_['aid']} into ms sql fails )" . $MSSQL->errMsg);
            }
        }
        else
        {
            $ret = false;
        }
        if($ret==false)
            ISyncLog::saveSyncLog($item_['uid'],4,$item_['aid']);

        return $ret;
    }

    public static function update($item_)
    {
        $ret   = true;
        $data  = array();
        $MSSQL = Config::getMSDB('Customer');
        if (false === $MSSQL)
        {
            self::$errCode = $MSSQL->errCode;
            self::$errMsg = $MSSQL->errMsg;
            Logger::err('connect to msserveer failed[]' . $MSSQL->errMsg);
            return false;
        }

        $sql = "SELECT CustomerSysNo FROM Customer_Address WHERE sysNo = {$item_['aid']}";
        $result = $MSSQL->getRows($sql);
        if (false === $result)
        {
            self::$errCode = $MSSQL->errCode;
            self::$errMsg = $MSSQL->errMsg;
            $ret = false;
        }
        else if (1 == count($result))
        {
            foreach (self::$WEB_ERP_PAIR_ADDRESS AS $web => $erp)
            {
                if (isset($item_[$web]))
                {
                    if ('name' === $web)
                    {
                        $data['Contact'] = self::translate($web, $item_, $MSSQL);
                    }
                    if ('district' === $web)
                    {
                        $area = ToolUtil::getLocInfo($item_['district']);
                        if (false !== $area)
                        {
                            $data['AreaName'] = $MSSQL->msEscapeStr($area['full_name']);
                        }
                    }
                    $data[$erp] = self::translate($web, $item_, $MSSQL);
                }
            }

            $ret = $MSSQL->update("Customer_Address", $data, "SysNo={$item_['aid']}");
            if (false === $ret)
            {
                self::$errCode = $MSSQL->errCode;
                self::$errMsg = $MSSQL->errMsg;
                Logger::err("update address id({$item_['aid']} into ms sql fails )" . $MSSQL->errMsg);
            }
        }
        else
        {
            $ret = false;
        }

        return $ret;
    }

    public static function delete($item_)
    {
        $ret = true;
        $MSSQL = Config::getMSDB('Customer');
        if (false === $MSSQL)
        {
            self::$errCode = $MSSQL->errCode;
            self::$errMsg = $MSSQL->errMsg;
            Logger::err('connect to msserveer failed[]' . $MSSQL->errMsg);
            return false;
        }

        $ret = $MSSQL->remove('Customer_Address', "sysNo = {$item_['aid']}");
        if (false === $ret)
        {
            self::$errCode = $MSSQL->errCode;
            self::$errMsg = $MSSQL->errMsg;
            Logger::err("delete address id({$item_['aid']} from ms sql fails )" . $MSSQL->errMsg);
            return false;
        }
        else
        {
            $sql = "SELECT sysno FROM Customer_Address_delete WHERE sysNo = {$item_['aid']}";
            $result = $MSSQL->getRows($sql);
            if (false === $result)
            {
                self::$errCode = $MSSQL->errCode;
                self::$errMsg = $MSSQL->errMsg;
                $ret = false;
            }
            else if (0 === count($result))
            {
                $ret = $MSSQL->insert("Customer_Address_delete", array('sysNo'=> $item_['aid'], 'CustomerSysNo' => $item_['uid'], 'rowCreateDate' => date('Y-m-d H:i:s', time())));
                if (false === $ret)
                {
                    self::$errCode = $MSSQL->errCode;
                    self::$errMsg = $MSSQL->errMsg;
                    Logger::err("insert the delete items of invoice_id({$item_['iid']} into ms sql fails )" . $MSSQL->errMsg);
                }
            }
        }

        return true;
    }

    private static function translate($name_, $item_, $MSSQL_)
    {
        if ('workplace' === $name_ || 'name' === $name_  || 'mobile' === $name_ || 'phone' === $name_
            || 'fax' === $name_ || 'zipcode' === $name_ || 'district' === $name_ || 'address' === $name_)
        {
            return $MSSQL_->msEscapeStr($item_[$name_]);
        }
        if ('regtime' === $name_ || 'updatetime' === $name_ )
        {
            return date('Y-m-d H:i:s', $item_[$name_]);
        }

        return $item_[$name_];
    }

    public static function setDefault($uid, $aid)
    {
        $ret = true;
        $MSSQL = Config::getMSDB('Customer');
        if (false === $MSSQL)
        {
            self::$errCode = $MSSQL->errCode;
            self::$errMsg = $MSSQL->errMsg;
            Logger::err('connect to msserveer failed[]' . $MSSQL->errMsg);
            return false;
        }

        $sql = "SELECT IsDefault FROM Customer_Address WHERE sysNo = {$aid} AND customersysno = {$uid}";
        $result = $MSSQL->getRows($sql);
        if (false === $result)
        {
            self::$errCode = $MSSQL->errCode;
            self::$errMsg = $MSSQL->errMsg;
            return false;
        }
        else if (1 == count($result))
        {
            $ret = $MSSQL->update("Customer_Address", array('IsDefault' => -1), "customersysno={$uid}");
            if (false === $ret)
            {
                self::$errCode = $MSSQL->errCode;
                self::$errMsg = $MSSQL->errMsg;
                Logger::err("update the IsDefault of address of user ({$uid} into ms sql fails )" . $MSSQL->errMsg);
                return false;
            }

            $ret = $MSSQL->update("Customer_Address", array('IsDefault' => 0), "sysno={$aid}");
            if (false === $ret)
            {
                self::$errCode = $MSSQL->errCode;
                self::$errMsg = $MSSQL->errMsg;
                Logger::err("update the IsDefault of address id ({$aid} into ms sql fails )" . $MSSQL->errMsg);
                return false;
            }
        }
        else
        {
            $ret = false;
        }

        return $ret;
    }
}
