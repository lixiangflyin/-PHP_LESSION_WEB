<?php
/**
 * 封装短信接口、邮件接口
 * @author 付学宝
 * @version 1.0
 * @created 31-三月-2011 15:00:40
 */
class IMessage
{
	/**
	 * 错误编码
	 */
	public static $errCode = 0;
	/**
	 * 错误信息,无错误为''
	 */
	public static $errMsg  = '';

	/**
	 * 清除错误信息,在每个函数的开始调用
	 */
	private static function clearError()
	{
		self::$errCode = 0;
		self::$errMsg	= '';
	}

	/**
	 * 邮件接口,成功则返回true,失败则返回false
	 *
	 * @param addr		邮箱地址
	 * @param subject   邮箱标题
	 * @param body		邮箱内容
	 * @param orderType 订单类型
     * [Description("销售单作废")]  AbandonSO = -1,  [Description("销售单生成")]  CreateSO = 0,
     * [Description("销售单审核")]  AuditSO = 1,     [Description("销售单出库")]  OutStock = 2,
     * [Description("销售单加分")]  AddDelayPoint = 3
     *
	 */
	static function sendEmail($addr, $subject, $body, $orderType=NULL)
	{
		self::clearError();
/*
		$sysNo = IIdGenerator::getNewId('asyncemail_sequence');
		if($sysNo === false){
			self::$errCode = 10001;
			self::$errMsg  = 'connect to msserveer failed[]'.$MSDB->errMsg;
			return false;
		}
*/
		$MSDB =  Config::getMSDB('ERP_1');//$MSDB = new MSSQL(MS_SQL_HOST, MS_SQL_PORT, MS_DB_NAME, MS_DB_USER, MS_DB_PASS);
		if (false === $MSDB) {
			self::$errCode = 10000;
			self::$errMsg  = 'connect to msserveer failed,'.Config::$errMsg;
			return false;
		}
		$data = array();
		$data['MailAddress'] = $addr;
		$data['MailSubject'] = $subject;
		$data['MailBody']  = $body;
		$data['Status']    = 0;
		$data['DateStamp'] = date('Y-m-d H:i:s');
		$data['EmailType'] = $orderType;
		$ret = $MSDB->insert('dbo.AsyncEmail', $data);
		if ($ret === false) {
			self::$errCode = $MSDB->errCode;
			self::$errMsg  = $MSDB->errMsg;
			return false;
		}
		return true;
	}

	/**
	 * 短信接口,成功则返回true,失败则返回false
	 *
	 * @param mobile    手机号码
	 * @param content   短信内容
	 */
	static function sendSMSMessageOld($mobile, $content)
	{
		self::clearError();
		// 短信平台自动添加tag，无需手动添加 2011-11-22
		// $content .= "【易迅网】";
		//通过移通网络短信平台发送
		$cdkey = "3SDK-EMS-0130-JJRSP";
		$password = "651350";
		$sm = iconv('GB2312', 'UTF-8', $content);
        $url = "http://219.239.91.112/sdkproxy/sendsms.action?cdkey=".$cdkey."&password=".$password."&phone=".$mobile."&message=".$sm."&addserial=";
        $val = NetUtil::cURLHTTPGet($url, 2, 'sdkhttp.eucp.b2m.cn');
		if ($val === false) {
			self::$errCode = NetUtil::$errCode;
			self::$errMsg  = NetUtil::$errMsg;
			return false;
		}
		$rval = iconv('UTF-8', 'GB2312', $val);
		$ret  = strstr($rval, '<error>0</error>');
		if ($ret == false) {
			self::$errCode = 10000;
			self::$errMsg  = $ret;
			return false;
		}
		return true;
	}
	
	public static function sendSMSMessage($mobile,$content) 
	{
		//预定义参数，参数说明见文档
		$spid="3948";
		$spsc="00";
		$sppassword="yx0628dz";
		$sa="10";
		$da="86".$mobile;
		$dc="15";
		$sm = $content;
		$host ="esms4.etonenet.com";
		//发送端口，默认80.
		$port=80;
		//拼接URI
		$request = "/sms/mt";
		$request.="?command=MT_REQUEST&spid=".$spid."&spsc=".$spsc."&sppassword=".$sppassword;
		$request.="&sa=".$sa."&da=".$da."&dc=".$dc."&sm=";
		$request.= self::encodeHexStr($dc, $sm);		
		return self::httpSend($host,$port,$request,"GET");//调用发送方法发送		
	}
	
	static function httpSend($host,$port,$request,$method) 
	{
		$httpHeader  = $method." ". $request. " HTTP/1.1\r\n";
		$httpHeader .= "Host: $host\r\n";
		$httpHeader .= "Connection: Close\r\n";
		//	$httpHeader .= "User-Agent: Mozilla/4.0(compatible;MSIE 7.0;Windows NT 5.1)\r\n";
		$httpHeader .= "Content-type: text/plain\r\n";
		$httpHeader .= "Content-length: " . strlen($request) . "\r\n";
		$httpHeader .= "\r\n";
		$httpHeader .= $request;
		$httpHeader .= "\r\n\r\n";
		$fp = @fsockopen($host, $port,$errno,$errstr,5);
		$result = "";
		if ( $fp ) {
			fwrite($fp, $httpHeader);
			while(! feof($fp)) { //读取get的结果
				$result .= fread($fp, 1024);
			}
			fclose($fp);
		}
		else
		{
			$errCode = -1;
			$errMsg = "连接短信网关超时！";

			EL_Flow::getInstance('send_sms')->append("mobile:{$mobile},result:faild,request timeout.", false);
			return false;//超时标志
		}

		EL_Flow::getInstance('send_sms')->append("mobile:{$mobile},result:{$result}", false);
		return true;
	}
	
	static function encodeHexStr($dataCoding, $realStr) {
		return bin2hex($realStr);
	}
}

