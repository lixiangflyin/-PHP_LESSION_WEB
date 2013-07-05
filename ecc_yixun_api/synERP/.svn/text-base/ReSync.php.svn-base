<?php
require_once('ISyncLog.php');
require_once(PHPLIB_ROOT .'api/IUser.php');
require_once('IUserSyn.php');
function ReOperation()
{
    $retVal=true;
    $retVal = ISyncLog::getRows('*','' , '', '');
    if($retVal == false) {
        return false;
    }
    foreach($retVal as $row)
    {
        switch ($row['bizid']) {
        case 1:
            $user_info_=GetUserInfo($row['uid']);
            if($user_info_!=false)
            {
                $result=IUserSyn::insert($user_info_);
                if($result!=false)
                {
                    ISyncLog::remove("uid ='{$row['uid']}' and bizid = '1'");
                }
            }
            break;
        case 4:
            $filter = array();
            if( $row['id'] > 0 )
            {
                $filter['aid'] = $row['id'];
            }
            $ret  = IUserAddressBookTTC::get($row['uid'], $filter);
            if($ret!=false)
            { 
                if(IUserAddressSyn::insert($ret[0])!=false)
                {
                    ISyncLog::remove("uid ='{$row['uid']}' and bizid = '4' and id='{$row['id']}'");
                }
            }
            break;
        case 7:
            $filter = array();
            if( $row['id'] > 0 )
            {
                $filter['iid'] = $row['id'];
            }
            $ret  = IUserInvoiceBookTTC::get($row['uid'], $filter);
            if($ret!=false)
            {  
                if(IUserInvoiceSyn::add($ret[0])!=false)
                {
                    ISyncLog::remove("uid ='{$row['uid']}' and bizid = '7' and id='{$row['id']}'");
                }
            }
            break;
        }
    }
    return $retVal;
}

function GetUserInfo($uid)
{
    $userInfo = IUsersTTC::get($uid);
    if (false === $userInfo || count($userInfo) != 1)
    {
        if(count($userInfo) == 0)
        {
            return false;
        }
        return false;
    }
    $item = IUserPassTTC::get($uid);
        if (false === $item) {
            return  false;
        }
    $userInfo[0]['pass']=$item[0]['pass'];
    $userInfo[0]['uid']=$uid;
    return $userInfo[0];
}
?>
