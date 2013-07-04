<?php

define( "TPHP_LIB_VERSTR",  "1.15.5" );


/**
 * 封装提交数据到oz的接口，仿照会员的tphp_msglog.php,仅仅修改了一些变量的命名
 * 
 */
class Report
{
	/**
	 * php_tmsglog.so中tmsglog_z对象
	 */
	private $msgLogObj = NULL ;

	/**
	 * Oper ID.
	 * @var string 
	 */
	private $operId = "" ;

	/**
	 * MsgLog构造函数
	 * @param $operId Oper ID.
	 */
	function __construct( $operId = "TPHP_MSGlOG" )
	{
		$this->operId = $operId ;

		if(!extension_loaded('php_tmsglog'))
		{
			if( !ini_get('safe_mode') && ini_get('enable_dl') )
			{
				if ( !@dl("php_tmsglog.so") )
				{
                    $suffix = ".".TPHP_LIB_VERSTR;
                    $suffix .= ".libc-".getLibcVer();
                    dl("php_tmsglog.so".$suffix);
                } 
			}
		}

		if ( !extension_loaded('php_tmsglog') )
		{
            user_error( "Load php_tmsglog module error.", E_USER_WARNING );
        }

        $this->msgLogObj = new tmsglog_z( 7, $operId );
	}

	/**
	 * Msg printf with time.
	 * @param   int     $msgid      Msg ID.
     * @param   int     $time       Time.
     * @param   string  $format     format.
     * @param   maxed args ...      args.
     * @return                      0: ok, other fail.
	 */
	function msgPringfT()
	{
		$args = func_get_args();
        array_unshift( $args, $this->operId );

        if ( function_exists( "tmsglog_msgprintf" ) )
		{
            $ret  = @call_user_func_array( "tmsglog_msgprintf", $args );
        } else {
            $ret = -9;
        } 

        return( $ret );
	}

    /**
     * Msg printf
     *
     * @param   int     $msgid      Msg ID.
     * @param   string  $format     format.
     * @param   maxed args ... 或者是值组成的数组     args.
     * @return                      0: ok, other fail.
     */
	function msgPrintf()
    {
        $args  = func_get_args();
		$len = count($args) ;
		
		if(is_array($args[$len - 1]))//记录的值可以以数组的形式传进来
		{
			$last = array_pop($args) ;
			$args = array_merge($args,$last) ;
		}
		
        $msgid = array_shift( $args );
        array_unshift( $args, 7, $msgid, time(0) );

		//print_r($args) ;

        $ret  = call_user_func_array( array($this->msgLogObj, "msgprintf"), $args );
        
		return( $ret );
    }

	 /**
     * get errmsg
     *
     * @param   void.
     * @return  string: errmsg.
     */
	function errMsg()
    {
        return $this->msgLogObj->errmsg();
    }

}
	/**
	 * Return libc version.
	 */
	function getLibcVer()
	{
		$arr = @glob( "/lib/libc-*.so" );
		$arr = explode( "-", @$arr[0] );
		$arr = explode( ".", @$arr[1] );

		return( @$arr[0].".".@$arr[1] );
	}

//End of script

