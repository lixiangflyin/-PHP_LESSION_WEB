<?php
require_once 'NetUtil.php';

//存放存储文件的文件夹
define('FILE_PATH', '/data/stat/data_report');

//设置Collection Server信息
$_REPORT_SRV_CFG = array();
$_REPORT_SRV_CFG['IP'] = '192.168.2.45';
$_REPORT_SRV_CFG['PORT'] = 20121;



//定义数据类型
define('DATA_TYPE_COUNT', 3);
define('DATA_TYPE_REALTIME', 1);
define('DATA_TYPE_1HOUR', 2);
define('DATA_TYPE_1DAY', 3);

//后缀名
define('FILE_SUFFIX', 'tmp');


/**
 * 数据存储的接口
 */
interface iStorage
{
	public static function write($biz_id, $type, $content);
}

/**
 * 封装写文件操作 
 */
class FileStorage implements iStorage
{
	/**
	 * 错误代码
	 */
	public static $errCode;
	
	/**
	 * 错误信息
	 */
	public static $errMsg;
	
	/**
	 * 将数据写入文件
	 * @param int $biz_id 业务ID
	 * @param int $type 数据类型
	 * @param string $content 原始数据内容
	 * @return boolean
	 */	
	public static function write($biz_id, $type, $content)
	{
		self::clearERR();
		self::checkFilePath(FILE_PATH);

		$file = self::getFileName($biz_id, $type);
		if(false == $file){
			return false;
		}
		
		$file = FILE_PATH.'/'.$file;
		$buff = self::encodeContent($biz_id, $type, $content);
		
		if(file_exists($file)){
			$ret = file_put_contents($file, $buff, FILE_APPEND);
			if(false == $ret){
				self::$errMsg = 'write file failed';
				return false;
			}			
		}else{
			$of = fopen($file, 'w');
			if(false == $of){
				self::$errMsg = 'open file failed';
				return false;
			}
			$ret = fputs($of, $buff);
			if(false == $ret){
				self::$errMsg = 'write file failed';
				fclose($of);
				return false;
			}
			fclose($of);
		}
		return true;
	}
	
	/**
	 * 拼装整个数据
	 * @param int $biz_id 业务ID
	 * @param int $type 数据类型
	 * @param string $content 数据内容
	 * @return string 拼装后数据内容
	 */	
	private static function encodeContent($biz_id, $type, $content)
	{
		return $content."\n";
	}

	/**
	 * 验证文件夹是否存在，如不存在创建该文件夹
	 * @param string $dir 文件夹路径
	 * @return boolean
	 */		
	private static function checkFilePath($dir)
	{
		return is_dir($dir) or (self::checkFilePath(dirname($dir)) and mkdir($dir, 0777));
	}
	
	/**
	 * 获取即将写入的文件名
	 * @param int $biz_id 业务ID
	 * @param int $type 数据类型
	 * @return string
	 */		
	private static function getFileName($biz_id, $type)
	{
		switch ($type) {
		case DATA_TYPE_1DAY:
			$time_type = 'd';	//精确到1天
			$time_diff = 24;	//24小时后上上报
			break;
				
		default:
			$time_type = 'h';	//精确到1小时
			$time_diff = 1;		//1小时后上上报
			break;
		}
		$create_time = self::timestamp2Timestring($time_type);
		$report_time = self::timestamp2Timestring($time_type, 0, $time_diff);
		return $biz_id.'_'.$type.'_'.$create_time.'_'.$report_time.'.'.FILE_SUFFIX;
	}


	/**
	* 将时间戳转化为字符串格式
	* 
	* @param ctype char 转化类型 's'精确到秒 'h'精确到小时 'd'精确到天 'm'精确到月
	* @param rawtime time_t 待转化时间戳 0表示当前时间
	* @param timediff time_t 相对rawtime时间timediff后的时间,单位hour
	* @return string 时间戳的字符串格式
	*/
	private static function timestamp2Timestring($ctype, $rawtime=0, $timediff=0)
	{
		if (0 == $rawtime)
		{
			$rawtime = time();
		}
		if (0 != $timediff)
		{
			$rawtime += $timediff * 3600;
		}

		//udp传输超时1s 所以这些数据至少是1s前得数据
		$rawtime -= 1;

		switch ($ctype)
		{
		case 's':
			return strftime ("%Y%m%d%H%M%S", $rawtime);

		case 'h':
			return strftime ("%Y%m%d%H", $rawtime);

		case 'd':
			return strftime ("%Y%m%d", $rawtime);

		case 'm':
			return strftime ("%Y%m", $rawtime);

		default:
			return false;
		}
	}


	/**
	 * 清除错误标识，在每个函数调用前调用
	 */
 	private static function clearERR()
	{
  		self::$errCode = 0;
	 	self::$errMsg = '';
 	}
}



/**
 * 封装网络传输操作 
 *
 */
class NetworkStorage implements iStorage
{
	/**
	 * 错误代码
	 */
	public static $errCode;
	
	/**
	 * 错误信息
	 */
	public static $errMsg;

	/**
	 * 传输udp包，传输失败转而写文件
	 * @param int $biz_id 业务ID
	 * @param int $type 数据类型
	 * @param string $content 数据内容
	 * @return boolean
	 */		
	public static function write($biz_id, $type, $content)
	{
		global $_REPORT_SRV_CFG;
		self::clearERR();
		$ret = NetUtil::udpCmd($_REPORT_SRV_CFG['IP'], $_REPORT_SRV_CFG['PORT'], self::encodeContent($biz_id, $type, $content), true, 1);
		if(!$ret){
			self::$errMsg = NetUtil::$errMsg;
			
			$ret = FileStorage::write($biz_id, $type, $content);
			if (false == $ret){
				self::$errMsg .= FileStorage::$errMsg;
			}
			return $ret;
		}else{
			return true;
		}
	}
	
	/**
	 * 拼装整个数据
	 * @param int $biz_id 业务ID
	 * @param int $type 数据类型
	 * @param string $content 原始数据内容
	 * @return string 拼装后数据内容
	 */	
	private static function encodeContent($biz_id, $type, $content)
	{
		return "bid=".$biz_id."&type=".$type."&time=".time()."&content=".$content."\n\n";
	}
	
	/**
	 * 清除错误标识，在每个函数调用前调用
	 */
 	private static function clearERR()
 	{
 		self::$errCode = 0;
		self::$errMsg = '';
 	}
}






/**
 * 封装上报数据操作 
 */
class DataReport
{
	/**
	 * 错误信息
	 */
	public static $errCode;
	
	/**
	 * 错误信息
	 */
	public static $errMsg;
	
	/**
	 * 上报数据
	 * @param int $biz_id 业务ID
	 * @param int $type 数据类型
	 * @param string $data 原始数据内容
	 * @return string boolean
	 */		
	public static function report($biz_id, $type, $data)
	{
		self::clearERR();
		$ret = self::checkArg($biz_id, $type);
		if( false == $ret ){
			return false;
		}

		if($type == DATA_TYPE_REALTIME){
			$ret = NetworkStorage::write($biz_id, $type, self::getContent($data));
			if(false == $ret){
				self::$errMsg = NetworkStorage::$errMsg;
			}
		}else{
			$ret = FileStorage::write($biz_id, $type, self::getContent($data));
			if(false == $ret){
				self::$errMsg = FileStorage::$errMsg;
			}
		}		
		return $ret;
	}
	
	/**
	 * 拼装要上报的数据内容
	 * @param array data    数据
	 * @return string
	 */
	private static function getContent($data)
	{
		$str = '';
		foreach ($data as $v)
		{
			//用“\t”分隔content内各字段
			$str .= self::escapeStr($v)."\t";
		}
		$str = substr($str,0,strlen($str)-1);
		return $str;
	}
	
	/**
	 * 过滤特殊字符
	 * @param string str    字符串
	 * @return string
	 */
	private static function escapeStr($str)
	{
		if ( is_numeric($str) ) {
			return $str;
		} else {
			//return str_replace(":", "\:", $str);
			return $str;
		}
	}
	
	/**
	 * 检查参数合法性
	 * @param int $biz_id 业务ID
	 * @param int $type 数据类型
	 * @return boolean
	 */		
	private static function checkArg($biz_id, $type)
	{
		self::clearERR();
		if (is_int($biz_id) && is_int($type)){
			if (($type <= DATA_TYPE_COUNT) && ($type > 0)){
				return true;
			}else{
				self::$errMsg = "ReportType:{$type}: range error";
				return false;
			}							
		}else{
			self::$errMsg = "invalid parameter(s)";
			return false;
		}
	}
	
	/**
	 * 清除错误标识，在每个函数调用前调用
	 */
 	private static function clearERR()
  {
  		self::$errCode = 0;
  		self::$errMsg = '';
  }
}

?>
