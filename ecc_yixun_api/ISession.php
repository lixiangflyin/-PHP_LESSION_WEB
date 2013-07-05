<?php
/**
 * 后端为ttc的session请求
 */

class ISession{
	// 生存时间
	private $lifeTime;
	private $logger;

	private static $errCode = 0;
	private static $errMsg = '';
	
	private static function setERR($code, $msg){
		self::$errCode = $code;
		self::$errMsg = $msg;
	}
	
	private static function clearERR(){
		self::setERR(0, '');
	}

	private static function createSession($sid, $newSessData = ""){
		$newSession = array(
			"sid"	=> $sid,
			"info"	=> $newSessData,
			"updatetime"	=> time()
		);
	
		$insert = IClientSessionTTC::insert($newSession);
		if($insert === false){
			self::setERR(9002, "IClientSessionTTC::insert failed, code: " . IClientSessionTTC::$errCode . '; msg: ' . IClientSessionTTC::$errMsg);
			return false;
		}
	
		return $newSession;
	}

	private function getSession($sid, $autoCreate = false){
		$session = IClientSessionTTC::get($sid);
		if($session === false){
			self::setERR(9003, "IClientSessionTTC::get failed, code: " . IClientSessionTTC::$errCode . '; msg: ' . IClientSessionTTC::$errMsg);
			return false;
		}

		if(count($session) <= 0){
			if($autoCreate){
				$session = self::createSession($sid, $autoCreate);
				if($session === false) return false;
			} else {
				return false;
			}
		} else {
			$session = $session[0];
		}

		return $session;
	}

	public function open($savePath, $sessName){
		$this->lifeTime = @ini_get("session.gc_maxlifetime");
		$this->logger = new Logger("session");

		return true;
	}

	public function read($sid){
		self::clearERR();

		$session = self::getSession($sid);
		if($session === false){
			$this->logger->warn(self::$errCode . "; " . self::$errMsg);
			return "";
		} else {
			return $session['info'];
		}
	}

	public function write($sid, $sessData){
		self::clearERR();

		$session = self::getSession($sid, $sessData);
		if($session === false){
			$this->logger->warn(self::$errCode . "; " . self::$errMsg);
			return false;
		}

		if($session['info'] == $sessData) return true;

		$session['info'] = $sessData;
		$session['updatetime'] = time();
		$update = IClientSessionTTC::update($session);
		if($update === false){
			return false;
		}

		return true;
	}

	public function close(){
		return true;
	}

	public function destroy($sid){
		self::clearERR();

		$remove = IClientSessionTTC::remove($sid);
		if($remove === false){
			return false;
		}
		return true;
	}
	
	function gc($sessMaxLifeTime){
		// 清除所有过期的session
		// TTC无法搜索，直接忽略
		return true;
	}
}