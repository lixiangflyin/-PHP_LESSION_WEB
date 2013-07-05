<?php
/**
 * 封装短信接口、邮件接口
 * @author hutli
 * @version 1.0
 * @created 20130528
 */


if (!defined("PHPLIB_ROOT")) {
	define('PHPLIB_ROOT', '/data/release/PHPLIB/');
} 
require_once(PHPLIB_ROOT . 'api/appplatform/touchdao_php5_stub.php');
require_once(PHPLIB_ROOT . 'lib/Config.php');
require_once(PHPLIB_ROOT . 'lib/ToolUtil.php');


class IMessageNew
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
	 * @param uid				易迅用户uid int
	 * @param businessType		(需要申请)业务类型 int
	 * @param flowId			(需要申请)子业务ID(环节ID) int
	 * @param template			(需要申请)模板ID int
	 * @param contentVector		消息内容,array('99998') array(string,string)
	 * @param target			邮箱地址 string
	 * @param ext2				是否聚合邮件（0普通，1聚合(仅QQ邮箱)） string
	 */
	static function sendEmail($uid,$businessType,$flowId,$template,$contentVector,$target,$ext2)
	{
		self::clearError();

		$opt = array(
			'uin'		=> $uid, 
			'operator'	=> 10000,
			'timeout'	=> 3
			);

		$contentParam = array(
							'version'			=> 3,		//版本号
							'ctime'				=> time(),	//时间
							'businessId'		=> 0,		//关联业务号
							'contentVector_u'	=> 1,		//启用消息内容Vector
							'content_u'			=> 0,		//停用消息内容string
							'channel'			=> 3,		//渠道ID(1 Tips  2 短信 3 邮件 4 站内信)
							'businessType'		=> $businessType,			//业务类型
							'flowId'			=> $flowId,					//子业务ID(环节ID)
							'template'			=> $template,				//模板ID
							'contentVector'		=> $contentVector,			//消息内容
							'target'			=> $target,					//email地址
							'ext2'				=> $ext2					//聚合非聚合邮件,0普通，1聚合

		);

		$req = array(
			'source' => '51buy new ime',
			//'scene' => 1,
			//'machineKey' => '123.123.123.123',
			'record' => $contentParam,
			'reserveIn' => ''
		);
		$result = WebStubCntl2::request(
						'\b2b2c\touch\dao\InsertRealTime',
						array(
								'opt' => $opt,
								'req' => $req)
				);
		//var_dump($result);
		/////////////////////////////////////////
		if ($result['code'] != 0) {
			self::$errCode = $result['code'];
			self::$errMsg  = $result['msg'];
			Logger::err("sendEmail failed,errCode:" . self::$errCode . ",errMsg:" . self::$errMsg);
			return false;
		}
		return true;
	}
	/**
	 * 短信接口,成功则返回true,失败则返回false
	 *
	 * @param uid				易迅用户uid int
	 * @param businessType		(需要申请)业务类型 int
	 * @param flowId			(需要申请)子业务ID(环节ID) int
	 * @param template			(需要申请)模板ID int
	 * @param contentVector		消息内容,array('99998') array(string,string)
	 * @param mobile			手机号码 string
	 */
	 public static function sendSMS($uid,$businessType,$flowId,$template,$contentVector,$mobile) 
	{
		self::clearError();
		$opt = array(
			'uin'		=> $uid, 
			'operator'	=> 10000,
			'timeout'	=> 3);
		$contentParam = array(
							'version'			=> 3,					//版本号
							'ctime'				=> time(),				//时间
							'businessId'		=> 0,					//关联业务号
							'contentVector_u'	=> 1,					//启用消息内容Vector
							'content_u'			=> 0,					//停用消息内容string
	 						'channel'			=> 2,					//渠道ID(1 Tips  2 短信 3 邮件 4 站内信)
							'businessType'		=> $businessType,		//业务类型
							'flowId'			=> $flowId,				//子业务ID(环节ID)
							'template'			=> $template,			//模板ID
							'contentVector'		=> $contentVector,		//消息内容
							'mobile'			=> $mobile				//手机号码
		);
		$req = array(
			'source' => '51buy IMessageNew',
			//'scene' => 1,
			//'machineKey' => '',
			'record' => $contentParam,
			//'reserveIn' => ''
		);
		$result = WebStubCntl2::request(
						'\b2b2c\touch\dao\InsertRealTime',
						array(
								'opt' => $opt,
								'req' => $req)
				);
		//var_dump($result);
		if ($result['code'] != 0) {
			self::$errCode = $result['code'];
			self::$errMsg  = $result['msg'];
			Logger::err("sendSMS failed,errCode:" . self::$errCode . ",errMsg:" . self::$errMsg);
			return false;
		}
		return true;
	}
}

	//IMessageNew::sendSMS(215431487,102,1,10041,array('99996'),'13510591715') ; 
	//IMessageNew::sendEmail(215431487,102,1,10961,array('99995'),'lishaobo0724@gmail.com',0)	//非聚合
	//IMessageNew::sendEmail(215431487,102,1,10195,array('99995'),'215431487@qq.com',1)			//QQ邮箱，聚合
?>