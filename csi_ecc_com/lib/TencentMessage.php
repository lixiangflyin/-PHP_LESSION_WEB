<?
/**
 * author donyhuang
 * 邮件内容标题编码必须是utf8
 */
class TencentMessage{
	const ADCKEY = "d46001649f5541999d870df10a32f724";//系统key改key只适用于10.12.194.109/10.180.73.121
	const WSURL = "http://ws.tof.oa.com/MessageService.svc?wsdl";//描述文件
	const NS = "http://www.w3.org/2001/XMLSchema-instance";
	const NSNODE = "http://schemas.datacontract.org/2004/07/Tencent.OA.Framework.Context";//命名空间
	const SENDER = "WEBITIL";

	private $_client;

	public function __construct(){
		$appkeyvar = new SoapVar("<Application_Context xmlns:i=\"".TencentMessage::NS."\"><AppKey xmlns=\"".TencentMessage::NSNODE."\">".TencentMessage::ADCKEY."</AppKey></Application_Context>",XSD_ANYXML);
		$this->_client = new SoapClient(TencentMessage::WSURL);
		$header = new SoapHeader(TencentMessage::NS, "Application_Context", $appkeyvar);
		$this->_client->__setSoapHeaders(array($header));//设置soap头
	}
	
	public function send($sendinfo,$type){//$type=1 rtx 2 sms 3 email
		if(is_array($sendinfo)&&in_array($type,array(1,2,3))){
			switch($type){
				case 1:
					return $this->_sendRtx($sendinfo);
					break;
				case 2:
					return $this->_sendSms($sendinfo);
					break;
				case 3:
					return $this->_sendEmail($sendinfo);
					break;		
			}
		}
	}
	
	private function _sendRtx($sendinfo){
		$msg = (object)array(
				'Sender'=>isset($sendinfo['sender'])?$sendinfo['sender']:TencentMessage::SENDER,
				'Receiver'=>$sendinfo['recvuser'],
				'Title'=>$sendinfo['title'],
				'MsgInfo'=>$sendinfo['msg'],
				'Priority'=>'Normal'
				);
		$param = array("message"=>$msg);
		$result = $this->_client->SendRTX($param);
		return $result->SendRTXResult;
	}
	
	private function _sendSms($sendinfo){
		$msg = (object)array(
				'Sender'=>isset($sendinfo['sender'])?$sendinfo['sender']:TencentMessage::SENDER,
				'Receiver'=>$sendinfo['recvuser'],
				'Title'=>$sendinfo['title'],
				'MsgInfo'=>$sendinfo['msg'],
				'Priority'=>'Normal'
				);
		$param = array("message"=>$msg);
		$result = $this->_client->SendSMS($param);
		return $result->SendSMSResult;
	}
	
	private function _sendEmail($sendinfo){
		if(isset($sendinfo['attachments']))
		{
			$attachments = array();
			for($i=0 ; $i<count($sendinfo['attachments']) ; $i++)
			{
				$tmp = $sendinfo['attachments'][$i];
				$attachments[] = (object)array(
					'FileContent' => $tmp['filecontent'],
					'FileName' => $tmp['filename']
				);
			}
		}
		$msg = (object)array(
			'Attachments'=>(isset($sendinfo['attachments'])?$attachments:NULL),
			'Bcc'=>"",
			'BodyFormat'=>'Html',
			'CC'=>$sendinfo['ccusers'],
			'Content'=>$sendinfo['msg'],
			'EmailType'=>'SEND_TO_ENCHANGE',
			'EndTime'=>date('c'),
			'From'=>isset($sendinfo['sender'])?$sendinfo['sender']:TencentMessage::SENDER,
			'Location'=>'',
			'MessageStatus'=>'Queue',
			'Organizer'=>'',
			'Priority'=>'Normal',
			'StartTime'=>date('c'),
			'Title'=>$sendinfo['title'],
			'To'=>$sendinfo['recvuser']
		);
		$param = array("mail"=>$msg);
		$result = $this->_client->SendMail($param);
		return $result->SendMailResult;
	}
}
