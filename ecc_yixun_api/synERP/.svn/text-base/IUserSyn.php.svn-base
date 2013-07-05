<?php
require_once('MSSQL.php');
require_once('TTC.php');
require_once('Logger.php');
require_once('ISyncLog.php');

class IUserSyn
{
    public static $errMsg = "";
    public static $errCode = 0;
    private static $WEB_ERP_PAIR_USER = array(
			    // in the table of users
			    'icsonid'         => "CustomerID",
			    'name'            => "CustomerName",
			    'sex'             => "Gender",
			    'email'           => "Email",
			    'phone'           => "Phone",
			    'mobile'          => "CellPhone",
			    'fax'             => "Fax",
			    'city'            => "DwellAreaSysNo",
			    'address'         => "DwellAddress",
			    'zipcode'         => "DwellZip",
			    'total_point'     => "TotalScore",
			    'valid_point'     => "ValidScore",
			    'idcard'          => "CardNo",
			    'note'            => "Note",
			    'regtime'         => "RegisterTime",
			    'level'           => "CustomerRank",
			    'is_manual_level' => "IsManualRank",
			    'type'            => "CustomerType",
			    'regIP'           => "RegisterIP",
			    'exp_point'       => "ExpPoint",
			    'updatetime'      => "rowModifydate",
			    // in the table of icson_login
			    'status'          => 'status',
			    // in the table of email_login
			    'email_status'    => 'EmailStatus',
			    // in the table of tel_login
			    'cellphone_status'=> 'cellPhoneStatus',
			    // in the table of user_extension
			    'recomend_score'  => 'RecomendScore',
			    'refer_uid'       => 'RefCustomerSysNo',
			    'vip_rank'        => 'VIPRank',
			    'web_power_group' => 'WebPowerGroup',
			);

    /**
     * Insert the user info into ERP
     */
    public static function insert($user_info_)
    {
        $ret   = true;
        $sex = ('m' == $user_info_['sex']) ? 1 : (('f' == $user_info_['sex']) ? 0 : 2 );
        $reg_time = date('Y-m-d H:i:s', $user_info_['regtime']);
        $sql   = "SELECT sysNo FROM Customer WHERE sysNo = {$user_info_['uid']}";
        $MSSQL = Config::getMSDB('ERP_1');
        if (false === $MSSQL)
        {
            Logger::err('connect to msserveer failed[]' . $MSSQL->errMsg);
            self::$errCode = $MSSQL->errCode;
            self::$errMsg = $MSSQL->errMsg;
            ISyncLog::saveSyncLog($user_info_['uid'],1,'');
            return false;
        }

        $result = $MSSQL->getRows($sql);
        if (false === $result)
        {
            Logger::err("get  user_id({$user_info_['uid']}) from sql fails " . $MSSQL->errMsg);
            self::$errCode = $MSSQL->errCode;
            self::$errMsg = $MSSQL->errMsg;
            ISyncLog::saveSyncLog($user_info_['uid'],1,'');
            return false;
        }
        else if (0 == count($result))
        {
            $data = array(
                "SysNo"         => $user_info_['uid'],
                "CustomerID"    => $user_info_['icsonid'],
                "CustomerName"  => $user_info_['name'],
                "Gender"        => $sex,
                "Email"         => $user_info_['email'],
                "Phone"         => $user_info_['phone'],
                "Pwd"           => $MSSQL->msEscapeStr($user_info_['pass']),
                "CellPhone"     => $user_info_['mobile'],
                "Fax"           => $user_info_['fax'],
                "DwellAreaSysNo"=> $user_info_['city'],
                "DwellAddress"  => $user_info_['address'],
                "DwellZip"      => $user_info_['zipcode'],
                "TotalScore"    => $user_info_['total_point'],
                "ValidScore"    => $user_info_['valid_point'],
                "CardNo"        => $user_info_['idcard'],
                "Note"          => $user_info_['note'],
                "RegisterTime"  => $reg_time,
                "CustomerRank"  => $user_info_['level'],
                "CustomerType"  => $user_info_['type'],
                "RegisterIP"    => $user_info_['regIP'],
                "ExpPoint"      => $user_info_['exp_point'],
                "rowModifydate" => $reg_time,
            );

            $ret = $MSSQL->insert("Customer", $data);
            if (false === $ret)
            {
                Logger::err("insert user_id({$user_info_['uid']} into ms sql fails )" . $MSSQL->errMsg);
                self::$errCode = $MSSQL->errCode;
                self::$errMsg = $MSSQL->errMsg;
                ISyncLog::saveSyncLog($user_info_['uid'],1,'');
                return false;
            }
        }
        else
        {
            ISyncLog::saveSyncLog($user_info_['uid'],1,'');
            $ret = false;
        }
        if($ret==false)
            ISyncLog::saveSyncLog($user_info_['uid'],1,'');

        return $ret;
    }

    public static function update($uid_, $user_info_)
    {
        $ret   = true;
        $data  = array();
        $MSSQL = Config::getMSDB('ERP_1');
        if (false === $MSSQL)
        {
            Logger::err('connect to msserveer failed[]' . $MSSQL->errMsg);
            self::$errCode = $MSSQL->errCode;
            self::$errMsg = $MSSQL->errMsg;
            return false;
        }

        $sql = "SELECT sysNo FROM Customer WHERE sysNo = {$uid_}";
        $result = $MSSQL->getRows($sql);
        if (false === $result)
        {
            self::$errCode = $MSSQL->errCode;
            self::$errMsg = $MSSQL->errMsg;
            return false;
        }
        else if (1 == count($result))
        {
            $date = array();
            foreach (self::$WEB_ERP_PAIR_USER as $web => $erp)
            {
                if (isset($user_info_[$web]))
                {
                    $data[$erp] = self::translate($web, $user_info_, $MSSQL);
                }
            }

            if(isset($user_info_['pass']))
            {
                // ¿ÕÃÜÂë²»¸üÐÂ
                if (!empty($user_info_['pass']))
                {
                    $data['Pwd'] = $user_info_['pass'];
                }
            }

            $ret = $MSSQL->update("Customer", $data, "SysNo={$uid_}");
            if (false === $ret)
            {
                Logger::err("update user_id({$uid_} into ms sql fails )" . $MSSQL->errMsg);
                self::$errCode = $MSSQL->errCode;
                self::$errMsg = $MSSQL->errMsg;
                return false;
            }
        }
        else
        {
            $ret = false;
        }

        return $ret;
    }

    private static function translate($name_, $item_, $MSSQL_)
    {
        if ('sex' === $name_)
        {
            return ('m' == $item_['sex']) ? 1 : (('f' == $item_['sex']) ? 0 : 2 );
        }
        if ('regtime' === $name_ || 'updatetime' === $name_ )
        {
            return date('Y-m-d H:i:s', $item_[$name_]);
        }
        if ('name' === $name_)
        {
            if (ToolUtil::hasMarsWord($name_))
            {
                return "";
            }

            return $MSSQL_->msEscapeStr($item_[$name_]);
        }
        if ('email' === $name_  || 'address' === $name_ || 'note' === $name_)
        {
            return $MSSQL_->msEscapeStr($item_[$name_]);
        }

        return $item_[$name_];
    }
}