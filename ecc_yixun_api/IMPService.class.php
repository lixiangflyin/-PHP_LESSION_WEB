<?php

class IMPService {
	
	const MP_CMD_PRESENT = 0x0203;
	const MP_CMD_MRMC_CDKEY = 0x040A;
	
	public static $errCode = 0;
	public static $errMsg = '';
	
	private static $mp_server = null;
	
	private static $_IP_CFG = array(
		'test' => array(
			'ADDRESS' => array(
				'IP' => '10.130.11.106',
				'PORT' => 20001
			)
		),
		'idc' => array(
			'ADDRESS' => array(
				'IP' => '10.129.132.23',
				'PORT' => 20001
			),
			'DNS' => array(
				array(
					'IP' => '10.208.129.179',
					'PORT' => 11123
				),
				array(
					'IP' => '10.130.73.152',
					'PORT' => 11123
				)
			)
		)
	);
	
	private static function clearErr() {
		self::$errCode = 0;
		self::$errMsg = '';
	}
	
	private static function getConfig() {
		$env = Config::getEnvName();
		if(!empty($env)) {
			$cfg_key = 'test';
		} else {
			$cfg_key = 'idc';
		}
		return self::$_IP_CFG[$cfg_key];
	}
	
	private static function getServer() {
		if(empty(self::$mp_server)) {
			$cfg = self::getConfig();
			self::$mp_server = new MPServer();
			
			if(!empty($cfg['DNS'])) {
				if(count($cfg['DNS']) == 1) {
					$dns_cfg = $cfg['DNS'][0];
					self::$mp_server->set_dns_address($dns_cfg['IP'], $dns_cfg['PORT']);
				} else if(count($cfg['DNS']) > 1) {
					$dns_cfg = $cfg['DNS'][0];
					$slave_dns_cfg = $cfg['DNS'][1];
					self::$mp_server->set_dns_address($dns_cfg['IP'], $dns_cfg['PORT'], $slave_dns_cfg['IP'], $slave_dns_cfg['PORT']);
				}
			}
			
			$address_cfg = $cfg['ADDRESS'];
			self::$mp_server->set_default_address($address_cfg['IP'], $address_cfg['PORT']);
			self::$mp_server->set_timeout(2);
		}
		
		return self::$mp_server;
	}
	
	public static function sendPresent($mp_no, $prize_no, $uin) {
		self::clearErr();
		
		$request = new MPRequest(self::getServer());
		
		$ret = true;
		$ret &= $request->init_header($mp_no, self::MP_CMD_PRESENT, $uin);
		$ret &= $request->set_param_string('PayChannel', 'qqacct');
		$ret &= $request->set_param_int('PresentTimes', 1);
		$ret &= $request->set_param_string('MPPresentList', $prize_no);
		$ret &= $request->set_param_uint32('PayUin', $uin);
		$ret &= $request->set_param_uint32('ProvideUin', $uin);
		if($ret === false) {
			self::$errCode = ErrorConfig::getErrorCode('init_request_failed');
			self::$errMsg = "Failed to init mp request.[ mp no : {$mp_no}, prize no : {$prize_no}, uin : {$uin} ]";
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
		
		$result = new MPResult();
		$ret = $request->execute($result);
		if($ret === false) {
			self::$errCode = $request->errno();
			self::$errMsg = "Failed to send present with mp no {$mp_no}, prize no {$prize_no}, uin {$uin}.";
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
		
		$result_code = $result->get_string_value('ResultCode');
		if($result_code == 0 || $result_code == 'OK') {
			return true;
		} else {
			$result_info = $result->get_string_value('ResultInfo');
			self::$errCode = $result_code;
			self::$errMsg = $result_info;
			return false;
		}
	}
	
	public static function sendCDKey($mp_no, $uin, $ip) {
		self::clearErr();
		
		$request = new MPRequest(self::getServer());
		
		$ret = true;
		$ret &= $request->init_header($mp_no, self::MP_CMD_MRMC_CDKEY, $uin);
		$ret &= $request->set_param_string('UserIP', $ip);
		$ret &= $request->set_param_string('CmdType', 'Get');
		if($ret === false) {
			self::$errCode = ErrorConfig::getErrorCode('init_request_failed');
			self::$errMsg = "Failed to init mp request.[ mp no : {$mp_no}, uin : {$uin} ]";
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
		
		$result = new MPResult();
		$ret = $request->execute($result);
		if($ret === false) {
			self::$errCode = $request->errno();
			self::$errMsg = "Failed to send cdkey with mp no {$mp_no}, uin {$uin}.";
			Logger::err(self::$errCode . ' : ' . self::$errMsg);
			return false;
		}
		
		$res = $result->get_string_value('Result');
		if($res != 0) {
			$result_code = $result->get_string_value('ResultCode');
			$result_info = $result->get_string_value('ResultInfo');
			Logger::err("mp cdkey error, mp no {$mp_no}, uin {$uin}.[ {$result_code} : {$result_info} ]");
			
			if($result_code == 50009) {
				// 用户资格受限
				$error_code = $result->get_string_value('ErrorCode');
				$error_info = $result->get_string_value('ErrorInfo');
				Logger::err("user not match, mp no {$mp_no}, uin {$uin}.[ {$error_code} : {$error_info} ]");
			}
			
			self::$errCode = $result_code;
			self::$errMsg = $result_info;
			return false;
		} else {
			$cdkey = $result->get_string_value('Account');
			return $cdkey;
		}
	}
}