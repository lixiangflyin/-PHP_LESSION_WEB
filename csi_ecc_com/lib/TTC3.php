<?php
// vim: set expandtab cindent tabstop=4 shiftwidth=4 fdm=marker:
// +----------------------------------------------------------------------+
// | The Club Movie Portal v2.0                                           |
// +----------------------------------------------------------------------+
// | Copyright (c) 2009, Tencent Inc. All rights reserved.                |
// +----------------------------------------------------------------------+
// | Authors: The Club Dev Team, ISRD, Tencent Inc.                       |
// |          sniferyuan <sniferyuan@tencent.com>                         |
// +----------------------------------------------------------------------+


/**
* @file     TTC3.php
* @version  1.0
* @author   sniferyuan
* @date     2010-06-13
*/

require_once 'tphp_ttc.php';

class TTC
{
    /* TTC错误码 */
    private $ttcCode = 0;

    /* TTC错误信息 */
    private $ttcMsg  = '';

    /* TTC操作主键 */
    private $ttcMainKey = '';

    /* TTC Host */
    private $ttcHost = '';

    /* TTC Port */
    private $ttcPort = 0;

    /* TTC table name */
    private $ttcTbName = '';

    /* timeout */
    private $timeout = 3;

    /* 连接TTC句柄 */
    private $server = NULL;

    /* TTC Request对象 */
    private $request = NULL;

    /* TTC result对象 */
    public $result = NULL;

    /* TTC GET操作返回的结果条数 */
    private $numRows = 0;

    /* TTC Config，存储GET、INSERT、UPDATE操作是的字段 */
    private $ttcConfig = NULL;

    /*{{{ __construct*/
    /**
     * class TTC构造函数
     * @param  host    TTC host
     * @param  port    TTC port
     * @param  tbname  TTC table name
     * @param  timeout TTC timeout
     * @return
     */
    function __construct( $host, $port, $tbname, $timeout = 3 )
    {
        $this->ttcHost   = $host;
        $this->ttcPort   = $port;
        $this->ttcTbName = $tbname;
        $this->timeout   = $timeout;
    }
    /*}}}*/

    /*{{{ getTtcCode*/
    /**
     * 返回TTC错误码
     * @return  错误码
     */
    public function getTtcCode()
    {
        return $this->ttcCode;
    }
    /*}}}*/

    /*{{{ getTtcMsg*/
    /**
     * 返回TTC错误信息
     * @return  错误信息
     */
    public function getTtcMsg()
    {
        $this->ttcMsg = $this->result->error_message();
        return $this->ttcMsg;
    }
    /*}}}*/

    /*{{{ getNumRows*/
    /**
     * 返回TTC GET操作的结果条数
     * @return  结果数
     */
    public function getNumRows()
    {
        $this->numRows = $this->result->num_rows();
        return $this->numRows;
    }
    /*}}}*/

    /*{{{ clear*/
    /**
     * 初始化为空
     */
    public function clear()
    {
        $this->ttcCode = 0;
        $this->ttcMsg  = '';
        $this->request = NULL;
        $this->result  = NULL;
        $this->numRows = 0;
    }
    /*}}}*/

    /*{{{ setMainKey*/
    /**
     * 设置TTC主键
     * @param  key    TTC key
     */
    public function setMainKey( $key )
    {
        $this->ttcMainKey = $key;
    }
    /*}}}*/

    /*{{{ setConfig*/
    /**
     * 存储操作TTC字段的数组
     * @param  ttckey    TTC字段数组
     */
    public function setConfig( $ttckey )
    {
        $this->ttcConfig = $ttckey;
    }
    /*}}}*/

    /*{{{ ttcInit*/
    /**
     * 初始化TTC
     */
    public function ttcInit()
    {
        $this->server = new tphp_ttc_server();
        $this->server->set_address( $this->ttcHost, $this->ttcPort );
        $this->server->set_timeout( $this->timeout );
        $this->server->set_tablename( $this->ttcTbName );
    }
    /*}}}*/

    /*{{{ setKey*/
    /**
     * 设置TTC主键
     * @param  $option   TTC操作类型符
     * @return  true设置成功，否则失败
     */
    public function setKey( $option )
    {
        list( $key, $value ) = $this->ttcMainKey;
        switch ( substr( $key, 0, 1 ) )
        {
            case 'i': $this->server->int_key();
                      $this->request = new tphp_ttc_request( $this->server, $option );
                      $this->request->set_key( $value );
                      return true;
            case 's': $this->server->string_key();
                      $this->request = new tphp_ttc_request( $this->server, $option );
                      $this->request->set_key_str( $value );
                      return true;
            default:  $this->ttcMsg = 'wrong_key_type';
                      return false;
        }
    }
    /*}}}*/

    /*{{{ need*/
    /**
     * 查询TTC时需要的字段
     */
    public function need()
    {
        if ( !empty( $this->ttcConfig ) )
        {
            foreach ( $this->ttcConfig as $key => $value )
            {
                $this->request->need( substr( $key, 1 ) );
            }
        }
    }
    /*}}}*/

    /*{{{ setParam*/
    /**
     * 设置INSERT和UPDATE操作的值
     */
    public function setParam()
    {
        foreach ( $this->ttcConfig as $key => $value )
        {
            $kkey = substr( $key, 1 );
            switch ( substr( $key, 0, 1 ) )
            {
                case 'i': $this->request->set( $kkey, $value );break;
                case 'f': $this->request->set_flo( $kkey, $value );break;
                case 's': $this->request->set_str( $kkey, $value );break;
                case 'b': $this->request->set_bin( $kkey, $value );break;
                default: break;
            }
        }
    }
    /*}}}*/

    /*{{{ getParam*/
    /**
     * 获取GET操作的值
     * @param  num   用户定制的需要取得记录的条数
     * @return array 结果数组
     */
    public function getParam( $num )
    {
        $array = array();
        $num = ( $num > $this->numRows ) ? $this->numRows : $num;
        $j = 0;
        for ( $i = 0; $i < $num; $i++ )
        {
            $ret = $this->result->fetch_row();
            if ( $ret >= 0 )
            {
                foreach ( $this->ttcConfig as $key => $value )
                {
                    $kkey = substr( $key, 1 );
                    switch ( substr( $key, 0, 1 ) )
                    {
                        case 'i': $array[$j][$kkey] = $this->result->int_value( $kkey );
                                  break;
                        case 'f': $array[$j][$kkey] = $this->result->float_value( $kkey );
                                  break;
                        case 's': $array[$j][$kkey] = $this->result->string_value( $kkey );
                                  break;
                        case 'b': $array[$j][$kkey] = $this->result->binary_value( $kkey );
                                  break;
                        default: break;
                    }
                }
                $j++;
            }
        }
        return $array;
    }
    /*}}}*/

    /*{{{ eq*/
    /**
     * 设置equal条件
     * @param  eq  equal条件数组
     */
    public function eq( $eq )
    {
        foreach ( $eq as $key => $value )
        {
            $kkey = substr( $key, 1 );
            switch ( substr( $key, 0, 1 ) )
            {
                case 'i': $this->request->eq( $kkey, $value );break;
                case 's': $this->request->eq_str( $kkey, $value );break;
                default: break;
            }
        }
    }
    /*}}}*/

    /*{{{ lt*/
    /**
     * 设置little条件
     * @param  little   little条件数组
     */
    public function lt( $lt )
    {
        foreach ( $lt as $key => $value )
        {
            $this->request->lt( $key, $value );
        }
    }
    /*}}}*/

    /*{{{ gt*/
    /**
     * 设置great条件
     * @param  gt    gt条件数组
     */
    public function gt( $gt )
    {
        foreach ( $gt as $key => $value )
        {
            $this->request->gt( $key, $value );
        }
    }
    /*}}}*/

    /*{{{ limit*/
    /**
     * 设置limit条件
     * @param  limit  limit条件数组
     */
    public function limit( $limit )
    {
        $this->request->limit( $limit['from'], $limit['num'] );
    }
    /*}}}*/

    /*{{{ add*/
    /**
     * 设置add
     * @param  add    add数组
     */
    public function add( $add )
    {
        foreach ( $add as $key => $value )
        {
            $this->request->add( $key, $value );
        }
    }
    /*}}}*/

    /*{{{ optTTC*/
    /**
     * TTC操作  遇到-110错误ttc会自动重试一次
     *
     * @param  operation    TTC操作符
     * @param  need         GET操作的数组
     * @param  lt           little条件数组
     * @param  gt           great条件数组
     * @param  limit        limit条件数组
     */
    public function optTTC( $operation, $eq = NULL, $lt = NULL, $gt = NULL, $limit = NULL, $add = NULL )
    {
        for ($i=0; $i<2; $i++)
        {
            $this->_optTtcOnce( $operation, $eq, $lt, $gt, $limit, $add );
            if ($this->ttcCode !== -110)
            {
                break;
            }
        }
    }
    /*}}}*/


    /**
     * TTC操作
     * @param  operation    TTC操作符
     * @param  need         GET操作的数组
     * @param  lt           little条件数组
     * @param  gt           great条件数组
     * @param  limit        limit条件数组
     */
    private function _optTtcOnce( $operation, $eq = NULL, $lt = NULL, $gt = NULL, $limit = NULL, $add = NULL )
    {
        $this->clear();
        if ( empty( $this->server ) )
        {
            $this->ttcInit();
        }
        $this->setKey( $operation );
        switch ( $operation )
        {
            case TPHP_TTC_OP_GET:    $this->need();break;
            case TPHP_TTC_OP_INSERT: $this->setParam();break;
            case TPHP_TTC_OP_UPDATE: $this->setParam();break;
            default: break;
        }
        if ( !empty( $eq ) )
        {
            $this->eq( $eq );
        }
        if ( !empty( $lt ) )
        {
            $this->lt( $lt );
        }
        if ( !empty( $gt ) )
        {
            $this->gt( $gt );
        }
        if ( !empty( $limit ) )
        {
            $this->limit( $limit );
        }
        if ( !empty( $add ) )
        {
            $this->add( $add );
        }
        $this->result = new tphp_ttc_result();
        $this->request->execute( $this->result );
        $this->ttcCode = $this->result->result_code();
    }
}
?>