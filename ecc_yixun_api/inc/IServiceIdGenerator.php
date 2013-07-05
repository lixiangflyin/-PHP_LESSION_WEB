<?php
require_once(PHPLIB_ROOT . 'api/appplatform/idmakerdao_stub4php.php');
require_once(PHPLIB_ROOT . 'api/appplatform/platform/web_stub_cntl.php');

class IServiceIdGenerator {
	public static $errCode = 0;
	public static $errMsg = '';

	private static $bizNameToCodeMap = array(
		'service_apply'	=> 186,
		'service_reply'	=> 187
	);

	/**
	 * 获取全局ID
	 * @param string $bizName
	 * @param int $need
	 * @return 连续的ID，返回第一个，之后自增即可。
	 */
	public static function getNewId($bizName, $need=1) {
		if (isset(self::$bizNameToCodeMap[$bizName])){
			return self::getId(self::$bizNameToCodeMap[$bizName]);
		} else {
			self::$errCode = 18;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[no such biz name]";
			return false;
		}
	}

	public static function getId($bizCode, $need = 1) {
		$idMakerRequest = new GetNeedIdsForU64Req();
		$idMakerRequest->BizType = $bizCode;
		$idMakerRequest->ReqSize = $need;

		$idMakerResponse = new GetNeedIdsForU64Resp();

		$stub = new WebStubCntl();
		$stub->setCallerName($bizCode);
		$ret = $stub->invoke($idMakerRequest, $idMakerResponse);
		if ($ret != 0){
			self::$errCode = 19;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[invoke failed, msg:" . $stub->last_err_msg . "]";
			var_dump(self::$errCode);
			var_dump(self::$errMsg);
			return false;
		}

		if($idMakerResponse->result != 0){
			self::$errCode = 20;
			self::$errMsg = basename(__FILE__, '.php') . " |" . __LINE__ . "[result error, code:" . $idMakerResponse->result . "]";
			var_dump(self::$errCode);
			var_dump(self::$errMsg);
			return false;
		}

		return $idMakerResponse->StartId;
	}
}
