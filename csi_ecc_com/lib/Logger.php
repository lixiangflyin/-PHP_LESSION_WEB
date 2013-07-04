<?php
require_once ROOT_DIR . 'lib/ToolUtil.php';
/**
 * 可以进行缓存, 利用析构函数来控制输入和输出,
 * 在 web server 上能大幅度提高性能, 在第一次写文件的时候才真正建立文件句柄
 */
class Logger
{
	const INFO  = 0;
	const WARN  = 1;
	const ERR   = 2;
	const FATAL = 3;

	// log 级别, 分为 INFO NOTICE WARN ERR (FATAL)
	private $level;

	// 保存 log 文件的时间
	private $logDate;

	// 保存 log 文件的句柄
	private $logFile;

	// 保存 log 文件名称
	private $logFileName;

	// 客户端 ip
	private $ip;

	// 单例模式
	private static $log;

	// 缓存
	private $records = array();

	// 记录 cache 中保存的流水的大小, 即每 20 条写一次文件
	private $maxRecordCount = 20;

	// 记录 cache 中当前保存的流水的数量
	private $curRecordCount = 0;

	// 当前进程ID
	private $processID = '0';

	/**
	 * 构造函数
	 *
	 * @param		string		$file, log文件名
	 * @return		void
	 */
	function __construct($logname = '')
	{
		if ( strlen($logname) ) {
			$logname		= self::_transFilename($logname);
			$logname		= basename($logname, '.log');
		} else {
			$logname		= basename($_SERVER['SCRIPT_NAME'], '.php');
		}
		$this->logFileName	= $logname . '.log';
		$this->level		= defined('LOG_LEVEL') ? LOG_LEVEL : self::ERR;
		$this->ip			= ToolUtil::getClientIP();
		$this->processID	= str_pad( (function_exists('posix_getpid') ? posix_getpid() : 0), 5 );
	}

	/**
	 * 析构函数
	 */
	function __destruct()
	{
		if ( $this->curRecordCount > 0 ) {
			$this->_flushToFile();
		}

		if ( !empty($this->logFile) ) {
			fclose($this->logFile);
		}
	}

	/**
	 * 打开log文件句柄, 初始化成员变量
	 */
	private function _setHandle()
	{
		$this->logDate	= date('Ymd');
		$logDir 		= LOG_ROOT . $this->logDate . '/';

		@umask(0);
		if ( !file_exists($logDir) ) {
			@mkdir($logDir, 0777, true);
		}

		$this->logFile	= fopen($logDir . $this->logFileName, 'a');
	}

	/**
	 * 转义文件名包含的非法字符
	 *
	 * @param		string		$filename, 文件名
	 *
	 * @return		string		$filename
	 */
	private function _transFilename($filename)
	{
		if  ( !strlen($filename) ) {
			return $filename;
		}

		$filename = str_replace('\\', '#', $filename);
		$filename = str_replace('/', '#', $filename);
		$filename = str_replace(':', ';', $filename);
		$filename = str_replace('"', '$', $filename);
		$filename = str_replace('*', '@', $filename);
		$filename = str_replace('?', '!', $filename);
		$filename = str_replace('>', ')', $filename);
		$filename = str_replace('<', '(', $filename);
		$filename = str_replace('|', ']', $filename);

		return $filename;
	}

	/**
	 * 初始化 log 文件名
	 *
	 * @param		string			$filename, log 文件名
	 *
	 * @return		void
	 */
	public static function init()
	{
		if ( empty(self::$log) ) {
			$stack	= debug_backtrace();
			$top_call = $stack[0];
			$logname = basename($top_call['file'], '.php');

			self::$log = new Logger($logname);
		}
	}

	private function _flushToFile(){
		if ( empty($this->logFile) || $this->logDate != date('Ymd') ) {
			if ( !empty($this->logFile) ) {
				fclose($this->logFile);
			}
			$this->_setHandle();
		}
		$str = implode("\n", $this->records);
		fwrite($this->logFile, $str . "\n");
		$this->curRecordCount = 0;
		$this->records = array();
	}
	/**
	 * 检测日志文件是否是当前日期的, 主要考虑 Server, Daemon
	 */
	private function _write($s)
	{
		if ( !strlen($s) ) {
			return false;
		}

		$this->records[] = $s;
		$this->curRecordCount++;

		if ( $this->curRecordCount >= $this->maxRecordCount ) {
			$this->_flushToFile();
		}

		return true;
	}

	/**
	 * 记录 info 型的 log
	 *
	 * @param		string		$str, log信息
	 */
	public static function info($str)
	{
		if ( empty(self::$log) ) {
			self::$log = new Logger();
		}

		return self::$log->logInfo($str);
	}

	/**
	 * 记录 warn 型的 log
	 *
	 * @param		string		$str, log信息
	 */
	public static function warn($str)
	{
		if ( empty(self::$log) ) {
			self::$log = new Logger();
		}

		return self::$log->logWarn($str);
	}

	/**
	 * 记录 error 型的 log
	 *
	 * @param		string		$str, log信息
	 */
	public static function err($str)
	{
		if ( empty(self::$log) ) {
			self::$log = new Logger();
		}

		return self::$log->logErr($str);
	}

	private function _logFormat($str, $level = self::ERR){
		$desc = '';
		if ($level == self::INFO){
			$desc = 'INFO';
		} else if ($level == self::WARN){
			$desc = 'WARN';
		} else if ($level == self::ERR){
			$desc = 'ERR';
		} else if ($level == self::FATAL){
			$desc = 'FATAL';
		}

		$trc = debug_backtrace(); // 0，当前函数；1，Logger中调用的函数；2，调用Logger的函数
		$s = date('Y-m-d H:i:s');
		$s .= "\t" . $desc . "\tPID:" . self::$log->processID;
		$s .= "\t" . $trc[2]['file'];
		$s .= "\tline " . $trc[2]['line'];
		$s .= "\tip:" . self::$log->ip . "\t";
		$s .= "\t" . $str;
		return $s;
	}

	public function logErr($str){
		if ( empty($str) ) {
			return false;
		}

		if ($this->level < self::ERR){
			return false;
		}

		return $this->_write(self::_logFormat($str, self::ERR));
	}

	public function logWarn($str){
		if ( empty($str) ) {
			return false;
		}

		if ($this->level < self::WARN){
			return false;
		}

		return $this->_write(self::_logFormat($str, self::WARN));
	}

	public function logInfo($str){
		if ( empty($str) ) {
			return false;
		}
	
		if ($this->level < self::INFO){
			return false;
		}
	
		return $this->_write(self::_logFormat($str, self::INFO));
	}
}

//End of script
