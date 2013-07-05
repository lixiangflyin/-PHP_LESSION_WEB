<?php
require_once('ImgTransfer.php');

class IKFImage{
	public static $errCode;
	public static $errMsg;

	const KF_TYPE_DEFAULT = 0;

	private static $config = false;

	private static function getPicConfig(){
		$servArr = explode(":", TFS_PICTURE_HOST);

		return self::$config = array(
			'IP'	=> $servArr[0],
			'PORT'	=> $servArr[1],
		);
	}

	private static function getFileName($uin, $imgType){
		return sprintf("%8X-%08X000000000000%012X.1.%s", time() - 3600, $uin, rand()%1000000000, $imgType == 1 ? 'gif' : 'jpg');
	}

	public static function upload($srcName, $uin, $imgType, $flag=1, $timeout=1){
		if ($imgType != 1 && $imgType != 2){
			self::$errCode = 20004;
			self::$errMsg = "img type not corret";
			return false;
		}

		$config = self::getPicConfig();
		if ($config === false) {
			return false;
		}

		$fileName = self::getFileName($uin, $imgType);
		$ret = ImgTransfer::upload($config['IP'], $config['PORT'], TFS_PICTURE_BUSINESS_ID, $srcName, $fileName, $flag, $timeout);
		if ($ret === false) {
			self::$errCode = 20003;
			self::$errMsg = "ImgTransfer::upload failed, code: " . ImgTransfer::$errCode . ', msg: ' . ImgTransfer::$errMsg;
			return false;
		}

		return $fileName;
	}

	public static function del($fileName, $timeout=1){
		self::clearERR();
		
		$config = self::getPicConfig();
		if ($config === false) {
			return false;
		}

		$ret = ImgTransfer::del($config['IP'], $config['PORT'], TFS_PICTURE_BUSINESS_ID, $fileName, $timeout);
		if ($ret === false) {
			self::$errCode = 20003;
			self::$errMsg = "ImgTransfer::upload failed, code: " . ImgTransfer::$errCode . ', msg: ' . ImgTransfer::$errMsg;
			return false;
		}
		
		return true;
	}

	public static function getUrl($name, $size){
		return ImgTransfer::getUrl(TFS_PICTURE_BUSINESS_ID, $name, $size);
	}
}