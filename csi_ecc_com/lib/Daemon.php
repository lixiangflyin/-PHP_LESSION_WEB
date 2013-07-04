<?php
/**
 * Daemon 的父类
 *
 * php testDaemon.php stop
 * php testDaemon.php start -n=5
 * @author 付学宝
 * @version 1.0
 * @created 28-06-2008 11:05:05
 * @modified by peterdu 2009-1-12
 */

error_reporting(E_ALL);
set_time_limit(0);
declare(ticks = 1);

require_once ROOT_DIR . 'lib/Logger.php';

abstract class Daemon
{
	const STOP	  = 'STOP';
	const RUNNING = 'RUNNING';

	// 错误编码
	public $errCode = 0;

	//错误信息, 无错误为''
	public $errMsg  = '';

	// 主进程表示子进程的数量, 子进程中为0
	private $processNum = 5;

	// 主进程表示子进程的数量, 子进程中为0
	private $defaultProcessNum = 5;

	// 当前处理请求的数量
	private $curRequestNum = 0;

	// 正确请求包的数量
	private $succRequestNum = 0;

	// 正确响应包的数量
	private $succResponseNum = 0;

	// 错误的请求包数量
	private $errRequestNum = 0;

	// 错误的响应包数量
	private $errResponseNum = 0;

	// 单个进程最大的处理的请求数量
	private $maxRequestNum = 100000;

	// 接收消息的最大长度

	private $maxLength	= 1024000;

	// 主进程中保存子进程的进程 id
	private $children = false;

	// 进程状态
	private $status	= self::RUNNING;

	// 保存进程的文件
	private $pidFile = false;


	function __construct($maxLength=10240)
	{
		$this->maxLength  = $maxLength;
	}

	function __destruct(){}

	/**
	 * 清除错误信息, 在每个函数的开始调用
	 */
	protected function clearError()
	{
		self::$errCode	= 0;
		self::$errMsg	= '';
	}

	/**
	 * 处理 daemon 外部的一些命令
	 */
	public function run()
	{
		//需要验证 ip 和端口的合法性
		$param = $this->analyseParam();

		$this->pidFile = '/tmp/PHP_DAEMON_'.$param['file'].'.pid';

		switch ($param['cmd']) {
			case 'start' :
				$this->start($param);
				break;
			case 'stop'  :
				$this->stop($param);
				break;
			default:
				Logger::err('unrecognized parameter');
				exit("unrecognized parameter.\n");
		}

		exit(0);
	}

	/**
	 * 启动
	 */
	private function start($param)
	{
		$this->processNum = $param['-n'];

		if ( file_exists($this->pidFile) ) {
			$pid = file_get_contents($this->pidFile);

			if ( file_exists("/proc/{$pid}") ) {
				Logger::warn('daemon is runing');
				exit("daemon is runing.\n");
			}

			unlink($this->pidFile);
		}

		$this->init();

		$this->_monitor();
	}

	/**
	 * 停止 daemon 的运行
	 */
	private function stop($param)
	{
		$pid = file_get_contents($this->pidFile);

		if( $pid === false ){
			Logger::err("stop fail. can not find pid {$this->pidFile}");
    		exit("error: stop fail. can not find pid {$this->pidFile}\n");
    	}

    	if ( !empty($param['method']) && $param['method'] == '-f' ) {
    		$ret = posix_kill($pid, SIGUSR2);
    	} else {
    		$ret = posix_kill($pid, SIGUSR1);
    	}

		if($ret){
			Logger::info("stop daemon succ");
			exit("succ: stop daemon succ.\n");
		}

		Logger::err("stop daemon fail");

		exit("error: stop daemon fail.\n");
	}

	/**
	 * 初始化主进程
	 */
	private function init()
	{
		$pid = pcntl_fork();
		// 创建子进程失败
		if ( $pid == -1 ) {
			Logger::err("start daemon fail. can not create process");
			exit("error: start daemon fail. can not create process.\n");
		} elseif ( $pid > 0 ) {
			exit(0);
		}

		posix_setsid();
		$pid = pcntl_fork();
		// 创建子进程失败
		if ( $pid == -1 ) {
			Logger::err("start daemon fail. can not create process");
			exit("error: start daemon fail. can not create process.\n");
		} elseif ( $pid > 0 ) {
			exit(0);
		}

		pcntl_signal(SIGHUP,  SIG_IGN);
		pcntl_signal(SIGINT,  SIG_IGN);
		pcntl_signal(SIGTTIN, SIG_IGN);
		pcntl_signal(SIGTTOU, SIG_IGN);
		pcntl_signal(SIGQUIT, SIG_IGN);

		$r = pcntl_signal(SIGUSR1, array($this, "signalHandle"));
		if ( $r == false ) {
			Logger::err("install SIGUSR1 fail");
			exit("error: install SIGUSR1 fail.\n");
		}

		$r = pcntl_signal(SIGUSR2, array($this, "signalHandle"));
		if ( $r == false ) {
			Logger::err("install SIGUSR2 fail");
			exit("error: install SIGUSR2 fail.\n");
		}

		$pid = posix_getpid();
		$r = file_put_contents($this->pidFile, $pid);
		if ( $r <= 0 ) {
			Logger::err("can not write pid file($this->pidFile)");
			exit("error: can not write pid file($this->pidFile).\n");
		}

		for ($i = 0; $i < $this->processNum; $i++) {
			$pid = pcntl_fork();
			if ( $pid == -1 ) {
				Logger::err("can not create fork");
				exit('error: can not create fork!');
			} elseif ( $pid == 0 ) {
				pcntl_signal(SIGUSR1, SIG_IGN);
				$this->children   = false;
				$this->pidFile	  = false;
				$this->processNum = false;
				$this->service();
				exit(0);
			}

			$this->children[$pid] = time();
		}
	}

	/**
	 * 监控主进程需要做的事情, 内部调用
	 */
	private function _monitor()
	{
		while (true) {
			$pid = pcntl_wait($status, WNOHANG);
			if ( $this->status === self::STOP ) {
				if ( count($this->children) <= 0 ) {
					unlink($this->pidFile);
					break;
				}

				if ( $pid > 0 && array_key_exists($pid, $this->children) ) {
					unset($this->children[$pid]);
				}
			} else {
				if ( $pid > 0 && array_key_exists($pid, $this->children) ) {
					unset($this->children[$pid]);
					$this->createProcess();
				} else {
					sleep(2);
					$this->monitor();
					$currTime = time();
				}
			}
		}
	}

	/**
	 * 处理请求
	 */
	private function service()
	{
		$this->taskBefore();

		while ( $this->status == self::RUNNING ) {
			if ( $this->curRequestNum > $this->maxRequestNum) {
				break;
			}

			$this->curRequestNum++;
			$message = $this->getMessage();
			$hasErr = false;
			$errMsg = '';

			if ($message === false) {
				$hasErr = true;
				$errMsg = $this->errMsg;
			}

			try {
				$ret = $this->task($message, !$hasErr, $errMsg);
			} catch (Exception $e) {
				$ret = false;
				Logger::err($e->getMessage());
			}

			if ($ret === false) {
				Logger::err('process task err');
				$this->errResponseNum++;
			} else {
				$this->succResponseNum++;
			}

			$currTime = time();
		}

		$this->taskAfter();
	}

	/**
	 * 监控主进程需要做的事情
	 */
	abstract public function monitor();

	/**
	 * 在每个进程启动前初始化一些操作
	 */
	public function taskBefore(){}

	/**
	 * 在每个进程启动前执行一些操作
	 */
	public function taskAfter()	{}

	/**
	 *
	 * @param string message    接收的数据
	 * @param bool   goodBag    标识数据是否正确
	 * @param string errMsg	    如果goodBag=false,此参数表示错误消息
	 *
	 * @return bool 处理成功了返回true,否则返回false,通过这个返回值统计上报
	 */
	//abstract public function task($message, $goodBag = true, $errMsg = '');php版本过底会抛处异常
	public function task($message, $goodBag = true, $errMsg = ''){}

	/**
	 * 创建一个进程
	 */
	private function createProcess()
	{
		$pid = pcntl_fork();
		if ( $pid == -1 ) {
			Logger::err('can not create process');
		} elseif ( $pid == 0 ) {
			pcntl_signal(SIGUSR1, SIG_IGN);
			$this->service();
			exit(0);
		}

		$this->children[$pid] = time();
	}


	/**
	 * 处理信号量
	 *
	 * @param signo    接收到的信号
	 */
	public function signalHandle($signo)
	{
		switch ($signo) {
			case SIGUSR1:
				$this->status = self::STOP;
				if (empty($this->children)) break;
				foreach($this->children as $k => $v){
					posix_kill($k, SIGUSR2);
				}
				break;
			case SIGUSR2:
				$this->status = self::STOP;
				if ( empty($this->children) ) break;
				foreach ($this->children as $k => $v) {
					posix_kill($k, SIGKILL);
				}
				break;
		}
	}

	/**
	 * 分析参数
	 */
	private function analyseParam()
	{
		$cmd = "/usr/local/php/bin/php server_file_name -k [start | stop] -n=num [-f]\n";

		$param['file'] = $_SERVER['SCRIPT_FILENAME'];
		$param['file'] = preg_replace('/\.php$/','', $param['file']);
		$param['file'] = preg_replace('/\//','', $param['file']);
		$param['file'] = preg_replace('/^\./','', $param['file']);

		$param['cmd'] = 'start'; // 默认为start
		$param['-n'] = 1; // 默认为1

		$opts = getopt('k:n:f');

		foreach ( $opts as $key => $val ) {
			$val = trim($val, '=');
			switch ( $key ) {
				case 'k' :
					if ($val == 'stop') {
						$param['cmd'] = 'stop';
					}
					break;
				case 'n' :
					$val = intval($val);
					if ( $val >= 500 || $val < 1 ) {
						Logger::err('param error');
						exit("param error!");
					}
					$param['-n'] = $val;
					break;
				case 'f' :
					if ($val === false) {
						$param['method'] = '-f';
					}
					break;
			}
		}

		if ($param['cmd'] != 'start' && $param['cmd'] != 'stop'){
			exit($cmd);
		}
		return $param;
	}

	/**
	 * 获得需要处理的消息,正确返回取到的消息,错误返回false
	 * @return string
	 */
	abstract public function getMessage();
}

//End of script
