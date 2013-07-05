<?php
/**
 * Created by JetBrains PhpStorm.
 * User: clydechang
 * Date: 13-1-22
 * Time: 下午2:11
 * To change this template use File | Settings | File Templates.
 */

if (!defined("PHPLIB_ROOT")) {
	define('PHPLIB_ROOT', '/data/release/PHPLIB/');
}
require_once(PHPLIB_ROOT . "lib/Config.php");


class EA_PointSecu
{
	// 安全积分检查阈值
	const SECURITY_THRESHOLD = 1000; // 1000 表示 100 个积分


	public $succMsg;

	public $errMsg;


	public $errCode;


	public $request;


	public $response;


	public $userInfo;


	public $orderInfo;


	// 安全检查类型定义
	const SECURITY_ACCOUNT_CHECK = 1;

	const SECURITY_GET_MOBILE = 2;

	const SECURITY_GET_CODE = 3;

	const SECURITY_VERIFY_CODE = 4;

	// 安全接口返回值
	const NEED_VERIFY = 1;

	const NEED_NOT_VERIFY = 0;


	public $visitkey;

	function __construct($userInfo, $orderInfo)
	{
		$this->errCode = 0;

		$this->errMsg = "";

		$this->userInfo = $userInfo;

		$this->orderInfo = $orderInfo;

		$this->response = false;


		$this->flowLog(ToolUtil::gbJsonEncode($userInfo));
		$this->flowLog(ToolUtil::gbJsonEncode($orderInfo));
	}

	// 下单前置积分检查
	public function preCheck($type)
	{
		$this->flowLog("下单前置积分检查 type:$type");
		$ret = false;
		switch ($type) {

			// 提交订单，需要验证账户安全性
			case self::SECURITY_ACCOUNT_CHECK:
				$ret = self::accountCheck();
				break;

			// 获取需要验证的手机验
			case self::SECURITY_GET_MOBILE:
				$ret = self::getMobile();
				break;

			// 获取手机验证码
			case self::SECURITY_GET_CODE:
				$ret = self::getCode();
				break;

			// 再次提交订单，对比手机验证码
			case self::SECURITY_VERIFY_CODE:
				$ret = self::verifyCode();
				break;
		}
		$this->flowLog("下单前置积分检查 结果:" . ToolUtil::gbJsonEncode($ret));
		return $ret;
	}

	// 积分使用安全验证
	public function accountCheck()
	{
		$userInfo = $this->userInfo;
		$orderInfo = $this->orderInfo;

		if (intval($orderInfo['point']) < self::SECURITY_THRESHOLD) {
			$this->errMsg = "使用积分{$orderInfo['point']}小于" . self::SECURITY_THRESHOLD . ",无需检查";
			return self::NEED_NOT_VERIFY;
		}


		$uid = $userInfo['uid'];


		$districtInfo = IShipping::getDistrictInfo($this->orderInfo['receiveAddrId']);
		if (false === $districtInfo) {
			$this->errMsg = IShipping::$errMsg;
			$this->errCode = IShipping::$errCode;
			return self::NEED_NOT_VERIFY;
		}


		$this->request = array(
			"scene_id"    => 1, //   ABC
			"time"        => time(), // 秒数 ABC
			"user_id"     => $uid, // 易迅ID， ABC
			"ip"          => ToolUtil::getClientIP(), // IP， ABC
			"vk"          => $orderInfo["visitkey"], // 易迅COOKIE， ABC
			"wireless"    => 0, // 是否在无线环境 0 -PC， 1-无线， ABC
			"total_point" => $userInfo['point'], // 积分总数（单位个） ABC
			"name"        => isset($orderInfo['receiver']) ? $orderInfo['receiver'] : '', // 收件人姓名 A
			"address"     => array( // 收件人地址 A
				"province"     => $districtInfo['province_name'],
				"city"         => $districtInfo['city_name'],
				"region"       => $districtInfo['district_name'],
				"full_address" => isset($orderInfo['receiveAddrDetail']) ? $orderInfo['receiveAddrDetail'] : '',
			),
			"mobile"      => isset($orderInfo['receiverMobile']) ? $orderInfo['receiverMobile'] : '',
			"total_fee"   => intval(isset($orderInfo['Price']) ? $orderInfo['Price'] : 0), // 订单金额， 单位分 A
			"point_pay"   => intval(isset($orderInfo['point']) ? $orderInfo['point'] : 0), // 使用积分个数
		);

		$this->flowLog("请求参数." . ToolUtil::gbJsonEncode($this->request));
		$ret = self::securityReqSend();
		if ($ret === false) {
			$this->flowLog("发送请求失败." . $this->errMsg);
			// 调用失败，放过检查
			return self::NEED_NOT_VERIFY;
		}

		$this->flowLog("请求成功." . ToolUtil::gbJsonEncode($this->response));
		// 是否需要检查积分
		return $this->response['need_verify'] == self::NEED_VERIFY ? self::NEED_VERIFY : self::NEED_NOT_VERIFY;
	}


	private function securityReqSend()
	{
		global $_IP_CFG;
		$this->flowLog(var_export($_IP_CFG['safeService'], true));

		$request = iconv("GBK", "UTF-8", ToolUtil::gbJsonEncode($this->request));
		// 发送到积分安全接口
		$response = NetUtil::udpCmd(
			$_IP_CFG['safeService']['ip'],
			$_IP_CFG['safeService']['port'],
			$request
		);

		$this->flowLog(var_export($response, true));
		if (empty($response)) {
			$this->errCode = NetUtil::$errCode;
			$this->errMsg = "安全积分接口调用失败" . NetUtil::$errMsg;
			$this->response = false;
			return false;
		}

		$response = json_decode($response, true);

		/*
		$response['need_verify'] = EA_PointSecu::NEED_VERIFY;
		$response['trusted_mobile_list'] = array(
			18621821680,
			15102105045,
		);
		*/
		$this->response = $response;

		return $this->response;
	}

	public function verifyCode($mobile = "")
	{
		$m = !empty($mobile) ? $mobile : $this->userInfo['mobile'];
		//验证code是否正确，如果没有指定手机，则验证用户的手机
		$this->flowLog($this->userInfo['uid']);
		$this->flowLog($this->orderInfo['verifycode']);
		$this->flowLog($m);
		$ret = IVerify::checkMobileVerifyCode(
			$this->userInfo['uid'],
			$this->orderInfo['verifycode'],
			$m
		);

		if (false === $ret) {
			$this->errCode = 5;
			$this->errMsg = "验证失败," . IVerify::$errMsg;
			return false;
		}

		return $ret;
	}

	public function getCode($mobile = "")
	{
		$mobile = self::getMobile($mobile);
		if (!is_numeric($mobile)) {
			return $mobile;
		}

		// 获取验证码
		$code = IVerify::getMobileVerifyCode($this->userInfo['uid'], $mobile);

		if (false === $code) {
			$this->errCode = 3;
			$this->errMsg = "获取验证码失败," . IVerify::$errMsg;
			return false;
		}

		//发送短信
		$ret = IMessage::sendSMSMessage($mobile, "您在易迅网使用积分下单，验证码为$code");
		if (false === $ret) {
			$this->errCode = 4;
			$this->errMsg = "获取验证码失败," . IMessage::$errMsg;
			return false;
		}

		//$this->succMsg = "已向您的手机\"$maskMobile\"发送验证码，请留意手机短信";
		return true;
	}


	public function flowLog($str, $backtrace = false, $folder = "point")
	{
		$vk = $this->visitkey;
		EL_Flow::getInstance("{$folder}")->append("vk:{$vk}," . $str, $backtrace);
	}

	private function getMobile()
	{
		$mobileInfo = array();
		if ($this->userInfo['bindMobile'] == 1 // 绑定了手机
			&& !empty($this->userInfo['mobile'])
		) // 且该手机号存在
		{
			$maskMobile = $this->maskMobile($this->userInfo['mobile']);
			$mobileInfo[] = array(
				'mobile' => $this->userInfo['mobile'],
				'mobile_mask' => $maskMobile,
			);
		} else {
			if (!empty($this->response['trusted_mobile_list'])) {
				foreach ($this->response['trusted_mobile_list'] as $m) {
					$maskMobile = $this->maskMobile($m);
					$mobileInfo[] = array(
						"mobile" => "{$m}",
						'mobile_mask' => $maskMobile,
					);
				}
			}
		}

		return $mobileInfo;
	}

	public function getVerifyKey($uid, $code)
	{
		//$pre_fix = "PointSecu";
        $pre_fix = "PointSecurity";
		$verify_key = md5($pre_fix . $uid . $code);

		return $verify_key;
	}

	public function maskMobile($mobile) {
		return preg_replace("/^(\d{3})\d{4}(\d{4})/", "$1****$2", $mobile);
	}
}