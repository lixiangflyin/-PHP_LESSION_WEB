<?php
/**
 * UdpServer
 * @author 付学宝
 * @version 1.0
 * @updated 08-七月-2008 21:51:15
 */

error_reporting(E_ALL);
set_time_limit(0);
declare(ticks = 1);

require_once ROOT_DIR . 'lib/Logger.php';
require_once ROOT_DIR . 'lib/NetUtil.php';

abstract class UdpServer
{
	const STOP	  = 'STOP';
	const RUNNING = 'RUNNING';

	// IP 地址
	protected $ip = false;

	// 端口
	protected $port = false;

	// 子进程 id
	private $child = false;

	// 是否需要发送回复
	protected $isResponse = false;

	// 启动时间
	private $startTime = false;

	// 黑名单
	protected $blacklist = false;

	// 白名单
	protected $whitelist = false;

	// 主进程中 server 的句柄
	private $serverHandle = false;

	// 当前处理请求的数量
	protected $curRequestNum = 0;

	// 正确请求包的数量
	protected $succRequestNum = 0;

	// 正确响应包的数量
	protected $succResponseNum = 0;

	// 错误的请求包数量
	protected $errRequestNum = 0;

	// 错误的响应包数量
	protected $errResponseNum = 0;

	// 单个进程最大的处理的请求数量
	protected $maxRequestNum = 100000;

	// 接收消息的最大长度
	protected $maxLength = 1024000;

	// 进程状态
	private $status = self::RUNNING;

	// 保存进程的文件
	private $pidFile = false;

	// 是否加包的长度校验
	private $wrap = true;

	function __construct($isResponse=true, $maxLength=10240, $blacklist=false, $whitelist=false, $wrap = true)
	{
		$this->maxLength	= $maxLength;
		$this->blacklist	= $blacklist;
		$this->whitelist	= $whitelist;
		$this->isResponse	= $isResponse;
		$this->wrap			= $wrap;
	}

	function __destruct(){}

	/**
	 * 监控主进程需要做的事情, 内部调用
	 */
	private function _monitor()
	{
		while (true) {
			$pid = pcntl_wait($status, WNOHANG);
			if ( $this->status === self::STOP ) {
				if ( $pid > 0 && $pid == $this->child ) {
					$this->child = false;
					break;
				} else {
					$this->ping();
				}
			} else {
				if ( $pid > 0 && $pid == $this->child ) {
					$this->child = false;
					$this->createProcess();
				} else {
					sleep(2);
					$this->monitor();
				}
			}
		}
		socket_close($this->serverHandle);
	}

	/**
	 * 处理 Server 外部的一些命令
	 */
	public function run()
	{
		// 需要验证 ip 和端口的合法性
		$param = $this->analyseParam();
		$this->ip   = $param['h'];
		$this->port = $param['p'];
		$this->pidFile = '/tmp/PHP_UDP_SERVER_'.$this->ip.'.'.$this->port;
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
	}

	/**
	 * 启动
	 *
	 * @param param
	 */
	private function start()
	{
		if ( file_exists($this->pidFile) ) {
			$pid = file_get_contents($this->pidFile);
			if ( file_exists("/proc/{$pid}") ) {
				Logger::err('server is runing');
				exit("server is runing.\n");
			}
			unlink($this->pidFile);
		}
		$this->init();
		$this->_monitor();
	}

	/**
	 * 停止 server 的运行
	 *
	 * @param param
	 */
	private function stop($param)
	{
		$pid = file_get_contents($this->pidFile);
		if ( $pid === false ) {
			Logger::err("stop fail. can not find pid file {$this->pidFile}");
    		exit("error: stop fail. can not find pid file {$this->pidFile}\n");
    	}

    	if ( !empty($param['method']) && $param['method'] == '-f' ) {
    		$ret = posix_kill($pid, SIGUSR2);
    	} else {
    		$ret = posix_kill($pid, SIGUSR1);
    	}

		if ($ret) {
			Logger::info("stop server succ");
			exit("succ: stop server succ.\n");
		}

		Logger::err("stop server fail");
		exit("error: stop server fail.\n");
	}

	/**
	 * 初始化主进程
	 */
	private function init()
	{
		$pid = pcntl_fork();
		// 创建子进程失败
		if ( $pid == -1 ) {
			Logger::err("start server fail. can not create process");
			exit("error: start server fail. can not create process.\n");
		} elseif ( $pid > 0 ) {
			exit(0);
		}

		posix_setsid();
		$pid = pcntl_fork();
		// 创建子进程失败
		if ( $pid == -1 ) {
			Logger::err("start server fail. can not create process", self::FATAL);
			exit("error: start server fail. can not create process.\n");
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

		$this->serverHandle = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
		if ( $this->serverHandle === false ) {
			$err = socket_strerror(socket_last_error());
			Logger::err("socket create fail.{$err}");
			exit("error: socket create fail.{$err}\n");
		}

		if ( !socket_set_option($this->serverHandle, SOL_SOCKET, SO_REUSEADDR, 1) ) {
			$err = socket_strerror(socket_last_error($this->serverHandle));
			socket_close($this->serverHandle);
			Logger::err($err);
			exit("error: {$err}.\n");
		}

		$bind = socket_bind($this->serverHandle, $this->ip, $this->port);
		if ( $bind == false ) {
			$err = socket_strerror(socket_last_error($this->serverHandle));
			socket_close($this->serverHandle);
			Logger::err($err);
			exit("error: socket bind fail.{$err}\n");
		}

		$pid = posix_getpid();
		$r = file_put_contents($this->pidFile, $pid);
		if ( $r <= 0 ) {
			Logger::err("can not write pid file($this->pidFile)");
			exit("error: can not write pid file($this->pidFile).\n");
		}

		$pid = pcntl_fork();
		if ( $pid == -1 ) {
			Logger::err("can not create fork", self::ERROR);
			exit('error: can not create fork!');
		} elseif ( $pid == 0) {
			pcntl_signal(SIGUSR1, SIG_IGN);
			$this->child	= false;
			$this->pidFile	= false;
			$this->startTime= time();
			$this->service();
			exit(0);
		}

		$this->child = $pid;
		$this->startTime = time();
	}

	/**
	 * 处理请求
	 */
	private function service()
	{
		$this->taskBefore();
		while ( $this->status == self::RUNNING ) {
			if ( $this->curRequestNum > $this->maxRequestNum ) {
				break;
			}

			$this->curRequestNum++;
			$ip = '';
			$port = 0;
			$hasErr = false;
			$errMsg = '';

			if ( $this->wrap ) {
				$message = NetUtil::udpSocketRecvFrom($this->serverHandle, $this->maxLength, $ip, $port);
				if ( $message === false ) {
					$hasErr = true;
					$errMsg = NetUtil::$errMsg;
				}
			} else {
				$ret = socket_recvfrom($this->serverHandle, $message, $this->maxLength, 0, $ip, $port);
				if ( $ret === -1 ) {
					$message = false;
					$hasErr = true;
					$errMsg = socket_strerror(socket_last_error());
				}
			}

			// 判断白名单
			if ( $hasErr === false && !empty($this->whitelist) && !in_array($ip, $this->whitelist) ) {
				$hasErr = true;
				$errMsg = "{$ip} is not allowed";
				Logger::err("{$ip} is not allowed");
			}

			// 判断黑名单
			if ( $hasErr === false && !empty($this->blacklist) && in_array($ip, $this->blacklist) ) {
				$hasErr = true;
				Logger::err("{$ip} is not allowed");
			}

			if ( $hasErr === true) {
				$this->errRequestNum++;
			} else {
				$this->succRequestNum++;
			}

			$response = '';
			try {
				$response = $this->task($message, !$hasErr, $errMsg);
			} catch (Exception $e) {
				Logger::err($e->getMessage());
			}

			// 发送消息
			if ($this->isResponse === false) {
				continue;
			}

			if ( $this->wrap ) {
				$ret = NetUtil::udpSocketSendTo($this->serverHandle, $response, $ip, $port);
				if ( $ret === false ) {
					Logger::err(NetUtil::$errMsg);
					$this->errResponseNum++;
				} else {
					$this->succResponseNum++;
				}
			} else {
				$len = strlen($response);
				$ret = socket_sendto($this->serverHandle, $response, $len, 0, $ip, $port);
				if ( $ret != $len ) {
					$errMsg = socket_strerror(socket_last_error());
					Logger::err($errMsg, self::ERROR);
					$this->errResponseNum++;
				} else {
					$this->succResponseNum++;
				}
			}
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
	public function taskAfter(){}

	/**
	 *
	 * @param message    接收的数据
	 * @param goodBag    标识数据是否正确
	 * @param errMsg    如果goodBag=false,此参数表示错误消息
	 */
	abstract public function task($message, $goodBag = true, $errMsg = '');

	/**
	 * 创建一个进程
	 */
	private function createProcess()
	{
		$pid = pcntl_fork();
		if ( $pid == -1 ) {
			Logger::err("can not create process");
		} elseif ( $pid == 0 ) {
			pcntl_signal(SIGUSR1, SIG_IGN);
			$this->service();
			exit(0);
		}
		$this->child = $pid;
	}

	/**
	 * 处理信号量
	 */
	public function signalHandle($signo)
	{
		switch ($signo) {
			case SIGUSR1:
				$this->status = self::STOP;
				if ( $this->child == false ) break;
				posix_kill($this->child, SIGUSR2);
				break;
			case SIGUSR2:
				$this->status = self::STOP;
				if ( $this->child == false ) break;
				posix_kill($this->child, SIGKILL);
				break;
		}
	}

	/**
	 * 分析参数
	 */
	private function analyseParam()
	{
		$tip = "usage: %server% [start | stop] -h ip -p port [-c cfg_id] [-f]\n";

		$param['cmd'] =	isset($_SERVER['argv'][1]) ? strtolower($_SERVER['argv'][1]) : 'start';

		if ( $param['cmd'] != 'stop' && $param['cmd'] != 'start' ) {
			exit($tip);
		}

		$opts = getopt('h:p:c:f');

		if ( !isset($opts['h']) || !isset($opts['p']) ) {
			exit($tip);
		}

		foreach ( $opts as $key => $val ) {
			$val = trim($val, '=');
			switch ( $key ) {
				case 'h' :
					if ( !ToolUtil::checkIP($val) ) {
						Logger::err("ip {$val} is invalid", self::ERROR);
						exit("ip[-h] is invalid\n");
					}
					$param['h'] = $val;
					break;
				case 'p' :
					$val = intval($val);
					if ( $val > 65535 || $val < 1025 ) {
						Logger::err("port[-p] {$val} must between 1025 and 65535");
						exit("port[-p] must be between 1025 and 65535\n");
					}
					$param['p'] = $val;
					break;
				case 'c' :
					$val = intval($val);
					if ( $val < 0 ) {
						Logger::err("config id[-c] {$val} can not be less than 0");
						exit("config id[-c] can not be less than 0\n");
					}
					$param['c'] = $val;
					break;
				case 'f' :
					if ( $val === false ) {
						$param['method'] = '-f';
					}
					break;
			}
		}

		return $param;
	}

	/**
	 * 向服务器发送一个空包以解除起阻塞状态
	 */
	private function ping()
	{
		NetUtil::udpCmd($this->ip, $this->port, '', false);
	}
}


//End of script
