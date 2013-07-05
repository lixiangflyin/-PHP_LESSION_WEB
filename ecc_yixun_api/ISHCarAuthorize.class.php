<?php
/**
 * 上汽用户登录验证类
 * @author oscarzhu
 * @version 1.0
 * @created 12-07-2012 15:26:06
 * @modified by EdisonTsai on 15:07 2012/11/02 for fix union-login failed
 */
require_once(PHPLIB_ROOT . 'lib/NetUtil.php');

class ISHCarAuthorize
{
	public static $SHCarID = '12';
	public static $SHCarKey = 'tencentxesjksj0212';

	/* @目前联合登录有问题先使用临时地址来过渡一下
	 * public static $SHCarCheckUrl = 'http://www.anyolife.com/interface/valid.aspx?service=valid';
	 */

	public static $SHCarCheckUrl = 'http://210.51.50.73:8092/interface/tempvalid.aspx?service=valid';

	/**
	 * 错误编码
	 */
	public static $errCode = 0;

	/**
	 * 错误消息
	 */
	public static $errMsg  = '';

	/**
	 * 设置错误信息
	 */
	private static function setERR($code, $msg){
		self::$errCode = $code;
		self::$errMsg = $msg;
	}

	/**
	 * 清空错误信息
	 */	
	private static function clearERR(){
		self::setERR(0, '');
	}
	
	/**
	 * 验证上汽用户接口
	 * @param int $id 用户登录标识
	 * @param string $name 用户名
	 */
	public static function authorize($id, $name){
		
		self::clearERR();
		
		$postData = array(
			'partner_id'	=>		self::$SHCarID,
			'partner_key'	=>		self::$SHCarKey,
			'username'		=>		$name,
			'uid'			=>		$id,
		);
		
		$dataArr = array();
		foreach ( $postData as $key=>$val ) 
		{
			$dataArr[] = $key.'='.$val;
		}
		$data = implode('&', $dataArr);

		$ret = NetUtil::cURLHTTPPost(self::$SHCarCheckUrl, $data, 3, '');
		//return array('userName'=>'yanagicrystal','realName'=>'yanagicrystal','password'=>'8475f47081f980a7b2a86c7bea884396');
		if( empty($ret) || $ret ===false || strlen($ret) == 5)
			return false;
		$data = substr(urldecode($ret), 5);
		//对方为utf8编码
		$tmp = explode('&', iconv('utf8','gbk',$data));
		return array(
			'realName'	=>	$tmp[3],
			'email'	=>	$tmp[1],
			'tel'	=>	$tmp[2],
			'password'	=>	$tmp[0],
			'carId'	=>	$tmp[4],
		);
	}
}

// End Of Script