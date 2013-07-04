<?php
/**
 * @description TOF客户端(Tencent OA Framework Client)
 * @author mikeliang
 * @version 1.0
 * @usage IP: 172.25.32.17(内网) IP: 10.130.1.178(外网)
 *
 *
 */

class TOFClient {
	public $errMsg = "";


	private $client;
	private $appkey;

	public function __construct($appkey) {
		$this->appkey = $appkey;
	}

	public function __destruct() {
		unset($this->client);
	}

	private function _initClient($service) {
		$wsURL = "http://ws.tof.oa.com/".$service.".svc?wsdl";
		$ns = "http://www.w3.org/2001/XMLSchema-instance";
		$nsnode = "http://schemas.datacontract.org/2004/07/Tencent.OA.Framework.Context";

		$this->errMsg = "";

		try {
			$appkeyvar = new SoapVar("<Application_Context xmlns:i=\"{$ns}\"><AppKey xmlns=\"{$nsnode}\">" . $this->appkey . "</AppKey></Application_Context>",XSD_ANYXML);
			$this->client = new SoapClient($wsURL);
			$header = new SoapHeader($ns, 'Application_Context',$appkeyvar);
			$this->client->__setSoapHeaders(array($header));
		} catch(SoapFault $ex){
			$this->errMsg = $ex->faultstring;
			return false;
		}
	}

	/**
	* 内容链接格式：[text|url]
	*/
	public function SendRTX($Sender, $Receiver, $Title, $MsgInfo, $Priority='Normal') {
		$this->errMsg = "";

		try {
			if($this->_initClient('MessageService') === false){
				return false;
			}

			$msg = (object) array(
				'Sender'		=> $Sender,
				'Receiver'		=> $Receiver,
				'Title'			=> $Title,
				'MsgInfo'		=> $MsgInfo,
				'Priority'		=> $Priority
			);
			$param = array('message' => $msg);
			$result = $this->client->SendRTX($param);
		} catch(SoapFault $ex){
			$this->errMsg = $ex->faultstring;
			return false;
		}

		return $result->SendRTXResult;
	}

	public function SendSMS($Receiver, $MsgInfo) {
		$this->errMsg = "";

		try {
			if($this->_initClient('MessageService') === false){
				return false;
			}
			// 对于短信，我们不太在意发送者、标题等信息
			$Sender = 'tencent';
			$Title = 'TOF_Client';
			$Priority='Normal';
			$msg = (object) array(
				'Sender'		=> $Sender,
				'Receiver'	=> $Receiver,
				'Title'			=> $Title,
				'MsgInfo'		=> $MsgInfo,
				'Priority'		=> $Priority
			);
			$param = array('message' => $msg);
			$result = $this->client->SendSMS($param);
		} catch(SoapFault $ex){
			$this->errMsg = $ex->faultstring;
			return false;
		}

		return $result->SendSMSResult;
	}

	public function SendMail($Sender, $Receiver, $Subject, $Msg, $CC = "", $Priority='Normal') {
		$this->errMsg = "";

		try {
			if($this->_initClient('MessageService') === false){
				return false;
			}
			$msg = (object) array(
				//'Attachments'	=> NULL,
				'Bcc'			=> '',
				'BodyFormat'	=> 'Html',
				'CC'			=> $CC,
				'Content'		=> $Msg,
				'EmailType'		=> 'SEND_TO_ENCHANGE',
				'EndTime'		=> date('c', strtotime('2019-12-25')),
				'From'			=> $Sender,
				'Location'		=> NULL,
				'Priority'		=> $Priority,
				'StartTime'		=> date('c'),
				'Title'			=> $Subject,
				'To'			=> $Receiver,
			);

			$param = array('mail' => $msg);
			$result = $this->client->SendMail($param);
		} catch(SoapFault $ex){
			$this->errMsg = $ex->faultstring;
			return false;
		}

		return $result->SendMailResult;
	}

	public function GetStaffInfoByName($loginName){
		$this->errMsg = "";
		
		try {
			if($this->_initClient('StaffService') === false){
				return false;
			}
		
			$param = array('loginName' => $loginName);
			$result = $this->client->GetStaffInfoByName($param);
		} catch(SoapFault $ex){
			$this->errMsg = $ex->faultstring;
			return false;
		}
		
		return $result->GetStaffInfoByNameResult;
	}

	public function CheckAuth() {
		$this->_initClient('AuthorizeService');
		$result = $this->Check();
		return $result;
	}

	public function getUser() {
		$auth_key = 'tof_auth';
		$c_key = self::get_str($auth_key);
		$ticket = self::get_str('ticket');
		if (isset($c_key) && $c_key) {
			$auth_str = $this->decode($c_key);
			if ($auth_str) return $auth_str;
			else die('Failed to decode: ');
		}
		if ($ticket) {
			$et = new eTicket();
			$et->encryptedTicket = $ticket;
			$mySoap = new SoapClient("http://passport.oa.com/services/passportservice.asmx?WSDL"); 
			$soapResult = $mySoap->DecryptTicket($et);

			$obj = new stdClass();
			$obj->LoginName = $soapResult->DecryptTicketResult->LoginName;
			$obj->ChineseName = $soapResult->DecryptTicketResult->ChineseName;
			$obj->DeptName = $soapResult->DecryptTicketResult->DeptName;
			
			$auth_str = $this->encode($obj);
			if ($auth_str) {
				setcookie($auth_key, $auth_str);
				$obj->AuthSuccess = true;
				return $obj;
			}
		}
		$in_url = 'http://passport.oa.com/modules/passport/signin.ashx';
		$out_url = 'http://passport.oa.com/modules/passport/signout.ashx';
		$host = $_SERVER['HTTP_HOST'];
		$myurl = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$title = 'SCMS';
		$post_url = "$in_url?url=".urlencode($myurl)."&title=".urlencode($title);
		header("Location: $post_url");
	}

	public function logout() {
		$auth_key = 'tof_auth';
		setcookie($auth_key, 0, -1);
		$out_url = 'http://passport.oa.com/modules/passport/signout.ashx';
		$host = $_SERVER['HTTP_HOST'];
		$myurl = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
		$title = 'SCMS';
		$post_url = "$out_url?url=".urlencode($myurl)."&title=".urlencode($title);
		header("Location: $post_url");
	}

	private function decode($str) {
		return json_decode($str);
	}

	private function encode($obj) {
		return json_encode($obj);
	}
	
	private function get_str($key, $default = '') {
		$v = isset($_REQUEST[$key]) ? $_REQUEST[$key] : $default;
		if (get_magic_quotes_gpc()) $v = stripslashes(trim($v));
		return $v;
	}
}

class eTicket {
  public $encryptedTicket;
  function eTicket() {
  }
}

