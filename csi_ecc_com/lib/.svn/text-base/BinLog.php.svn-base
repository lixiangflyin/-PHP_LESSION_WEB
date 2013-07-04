<?php
/**
 * 记录一些php需要处理的流水的日志类
 * @author 付学宝
 * @version 1.0
 * @updated 03-七月-2008 23:45:23
 */
class BinLog
{
	// 日志文件名称
	private $curBinLogFileName;
	private $binLogDir;

	// 保存流水
	private $records = array();

	// 记录 cache 中保存的流水的大小, 即每 100条写一次文件
	private $maxRecordCount;

	// 保存log文件的句柄
	private $logFile;
	private $intervalTime;

	function __construct($binlogDir, $intervalTime, $maxRecordCount=1)
	{
		$this->binLogDir = $binlogDir;
		$this->intervalTime = $intervalTime;
		$this->maxRecordCount = $maxRecordCount;
	}

	function __destruct()
	{
		$this->cacheToDisk();
		if ( !empty($this->logFile) ) {
			fclose($this->logFile);
		}
	}

	/**
	 * 记录log
	 *
	 * @param		string		$str, log信息
	 */
	function log($str)
	{
		$this->records[]="{$str}\n";
		if ( count($this->records) >= $this->maxRecordCount ) {
			$this->cacheToDisk();
		}

		return true;
	}

	/**
	 * 把cache中的记录数写入磁盘中
	 */
	private function cacheToDisk()
	{
		$len = count($this->records);
		if ( $len == 0 ) {
			return true;
		}
		$curTime = time();
		$curTime = floor($curTime / $this->intervalTime) * $this->intervalTime;
		$curTime = date('YmdHis',$curTime);
		$binFileName = $this->binLogDir .'/'. $curTime .'.bin';
		if ( empty($this->logFile) ){
			$this->curBinLogFileName = $binFileName;
			$this->logFile = fopen($this->curBinLogFileName, 'a');
		} elseif ( $this->curBinLogFileName != $binFileName ) {
			if ( !empty($this->logFile) ) {
				fclose($this->logFile);
			}
			$this->curBinLogFileName = $binFileName;
			$this->logFile = fopen($this->curBinLogFileName, 'a');
		}

		for ($i = 0; $i < $len; $i++) {
			fwrite($this->logFile, $this->records[$i]);
		}
		$this->records = array();
		return true;
	}
}

//End of script

