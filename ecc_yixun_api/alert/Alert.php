<?php
/**
 * The class definition for Alert APIs.
 */

require_once 'AlertAgent.php';

final class Alert
{
	/**
	 * doAlert
	 */
	public static function doAlert(
		$priority,  // Priority
		$apiName,   // API name
		$siteId,    // SiteId
		$netType,   // Network type.
		$netState,  // Network status.
		$uid = "",
		$cost = 0,
		$errCode = 0,
		$errMsg = "",
		$orderId = "",
		$extra = ""
	)
	{
		// Check the arguments.
		if( empty($apiName) )
			return false;
		
		// Post the request.
		self::sendIt($priority, $apiName, $siteId, $netType, $netState, $uid, $cost, $errCode, $errMsg, $orderId, $extra);
		
		return true;
	}
	
	private static function sendIt(
		$priority,  // Priority
		$apiName,   // API name
		$siteId,    // SiteId
		$netType,   // Network type.
		$netState,  // Network status.
		$uid = "",
		$cost = 0,
		$errCode = 0,
		$errMsg = "",
		$orderId = "",
		$extra = ""
	)
	{
		$agent = new AlertAgent();
		$agent->process($priority, $apiName, $siteId, $netType, $netState, $uid, $cost, $errCode, $errMsg, $orderId, $extra);
	}
	
	/*
	private static function postIt(
		$apiName,   // API name
		$alertId,  // Alert type, refert to AlertConfig.php
		$siteId,    // SiteId
		$uid = "",
		$cost = 0,
		$errCode = 0,
		$errMsg = ""
	)
	{
		// Please refer to the URLs
		// http://www.codesky.net/article/201202/163335.html
		// http://unmi.cc/php-simulate-multithread
		$errno = 0;
		$errmsg = "";
		$fs = fsockopen('localhost', 80, &$errno, &$errmsg, 0);
		if( !$fs )
			return false;
		
		// Send a asynchronous way to processor.
		$request = "GET /process.php?&api='$apiName'&alert='$alertId'&site='$siteId'&uid='$uid'&cost='$cost'&err='$errCode'&msg='$errMsg' / HTTP/1.1\r\n";
		fputs($fs, $request);
		fclose($fs);
	}
	*/
}

?>