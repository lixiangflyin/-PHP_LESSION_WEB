<?php
/**
 * µ¼¹ºÉÌsession
 * @author zhiliu
 * @version 1.0
 */

define ('TIMEOUT_SPAN', 3600*24);

class IBSession {
	public static $errCode = 0;
	public static $errMsg = '';
    public static  $ENCODE_KEY = 'B51BuyCOm';
    public static function getSession($uid)
    {
        $ret = IBSessionTTC::get($uid, array(), array('skey'));

        if (false === $ret)
        {
            self::$errCode = IBSessionTTC::$errCode;
            self::$errMsg = IBSessionTTC::$errMsg;

            return false;
        }

        $skey = self::encode($uid);
        if (0 === count($ret))
        {
        	$ret = IBSessionTTC::insert(array('uid'=>$uid, 'skey'=> $skey, 'timestamp'=>time()));
        }
        else
        {
        	$skey = $ret[0]['skey'];
        	$ret = IBSessionTTC::update(array('uid'=>$uid, 'skey'=> $skey, 'timestamp'=>time()));
        }

        if (false === $ret)
        {
            self::$errCode = IBSessionTTC::$errCode;
            self::$errMsg = IBSessionTTC::$errMsg;

            return false;
        }

        return $skey;
    }

    public static function checkSession($uid, $skey)
    {
    	$ret = IBSessionTTC::get($uid, array('skey'=>$skey));

    	if (false === $ret)
        {
            self::$errCode = IBSessionTTC::$errCode;
            self::$errMsg = IBSessionTTC::$errMsg;

            return false;
        }

        if (0 === count($ret))
        {
            self::$errCode = 10001;
            self::$errMsg = 'session is wrong';

        	return false;
        }

        $timestamp = $ret[0]['timestamp'];
        if ($timestamp-time() > TIMEOUT_SPAN)
        {
            self::$errCode = 10002;
            self::$errMsg = 'session is time out';

        	return false;
        }

        $ret = IBSessionTTC::update(array('uid' => $uid, 'timestamp' => time()), array('skey' => $skey));
        if (false === $ret)
        {
            self::$errCode = IBSessionTTC::$errCode;
            self::$errMsg = IBSessionTTC::$errMsg;

            return false;
        }

        return true;
    }

    public static function delSession($uid)
    {
    	$ret = IBSessionTTC::remove($uid);

        if (false === $ret)
        {
            self::$errCode = IBSessionTTC::$errCode;
            self::$errMsg = IBSessionTTC::$errMsg;

            return false;
        }

        return true;
    }

    private static function encode($uid)
    {
    	$ip = ToolUtil::getClientIP();
    	$input = $uid . self::$ENCODE_KEY . $ip . time();

    	return md5($input);
    }
}
