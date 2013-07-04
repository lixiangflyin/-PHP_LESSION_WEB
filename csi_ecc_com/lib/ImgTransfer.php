<?php 

//require "Config.php";

class ImgTransfer {
	/**
	 * 错误编码
	 * @var int
	 */
	public static $errCode = 0;

	/**
	 * 错误信息
	 * @var string
	 */
	public static $errMsg = '';

	/**
	 * 清除错误标识，在每个函数调用前调用
	 */
	private static function clearERR()
	{
		self::$errCode = 0;
		self::$errMsg  = '';
	}
	
	public static function upload($ip, $port, $businessId, $srcName, $descName, $flag=1, $timeout=1){
		self::clearERR();
		
		$connent	= self::_connectInit($ip, $port, $businessId, $timeout);
		if ($connent === false) return false;
		
		$tran	= qqbuy_store_raw_overwrite_v2($descName, $srcName, $flag);
		if ( $tran != 0 ){
			self::$errCode	= 1003;
			self::$errMsg	= "tran img fail. ret:{$tran}";
			return false;
		}
		
		return $tran;
	}
	
	public static function del($ip, $port, $businessId, $fileName, $timeout=1){
		self::clearERR();
		
		$connent	= self::_connectInit($ip, $port, $businessId, $timeout);
		if ($connent === false) return false;
		
		$del	= qqbuy_store_raw_delete($fileName);
		if ( $del != 0 ){
			self::$errCode	= 1004;
			self::$errMsg	= "del img fail. fileName-{$fileName} ret:{$del}";
			return false;
		}
		
		return true;
	}
	
	public static function getUrl($businessId, $name, $size){
		return "http://shp.qpic.cn/{$businessId}/0/{$name}/{$size}";
	}
	
	
	private function _connectInit($ip, $port, $businessId, $timeout=1){
		$setIP	= qqbuy_store_set_ip_port($ip, $port);
		if (!empty($setIP)){
			self::$errCode	= 1000;
			self::$errMsg	= "qqbuy_store_set_ip_port fail. ip:{$ip} port:{$port} ret:{$setIP}";
			return false;
		}
		
		$setTimeOut	= qqbuy_store_set_net_timeout($timeout);
		if (!empty($setTimeOut)){
			self::$errCode	= 1001;
			self::$errMsg	= "qqbuy_store_set_net_timeout fail. timeout:{$timeout} ret:{$setIP}";
			return false;
		}

		$setId	= qqbuy_store_set_business_id($businessId);
		if (!empty($setId)){
			self::$errCode	= 1002;
			self::$errMsg	= "qqbuy_store_set_net_timeout fail. businessId:{$businessId} ret:{$setId}";
			return false;
		}
		
		return true;
	}
	
	
}

