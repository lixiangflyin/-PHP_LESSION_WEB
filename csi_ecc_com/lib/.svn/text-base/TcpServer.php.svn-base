<?php
/**
 * TCP Server的父类
 *
 * php testTcpServer.php stop -h=192.168.0.10 -p=8080
 * php testTcpServer.php start -h=192.168.0.10 -p=8080 -n=5
 * @author 付学宝
 * @version 1.0
 * @created 28-六月-2008 11:05:05
 */
error_reporting(E_ALL);
set_time_limit(0);
declare(ticks = 1);

require_once ROOT_DIR . 'lib/Logger.php';
require_once ROOT_DIR . 'lib/ToolUtil.php';
require_once ROOT_DIR . 'lib/NetUtil.php';

abstract class TcpServer
{
	const STOP	  = 'STOP';
	const RUNNING = 'RUNNING';

	// server 绑定的 IP 地址
	protected $ip = false;

	// server 绑定的 Port
	protected $port = false;

	// 黑名单
	protected $blacklist = false;

	// 白名单
	protected $whitelist = false;

	// 主进程中 server 的句柄
	protected $serverHandle = false;

	// 端口的排队队列的大小
	protected $backlog = 100;

	// 主进程表示子进程的数量, 子进程中为 0
	protected $processNum = 5;

	// 主进程表示子进程的数量, 子进程中为 0
	protected $defaultProcessNum = 5;

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

	// 保存当前请求客户端 IP
	protected $clientIp;

	// 是否加包的长度校验
	private $wrap = true;

	// 主进程中保存子进程的进程 id
	private $children = false;

	// 进程状态
	private $status = self::RUNNING;

	// 保存进程的文件
	private $pidFile = false;

	function __construct($maxLength=10240, $blacklist=false, $whitelist=false, $backlog=50, $wrap = true)
	{
		$this->maxLength	= $maxLength;
		$this->backlog		= $backlog;
		$this->blacklist	= $blacklist;
		$this->whitelist	= $whitelist;
		$this->wrap			= $wrap;
	}

	function __destruct(){}

	/**
	 * 处理Server外部的一些命令
	 */
	public function run()
	{
		// 需要验证 ip 和端口的合法性
		$param = $this->analyseParam();
		$this->ip   = $param['h'];
		$this->port = $param['p'];
		$this->pidFile = '/tmp/PHP_TCP_SERVER_'.$this->ip.'.'.$this->port;
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
	 */
	private function start($param)
	{
		$this->processNum = $param['n'];
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
	 * 停止server的运行
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
			Logger::err("start server fail. can not create process");
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

		$this->serverHandle = @socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		if ( $this->serverHandle === false ) {
			$err = @socket_strerror(@socket_last_error());
			Logger::err("socket create fail.{$err}");
			exit("error: socket create fail.{$err}\n");
		}

		if ( !@socket_set_option($this->serverHandle, SOL_SOCKET, SO_REUSEADDR, 1) ) {
			$err = @socket_strerror(@socket_last_error($this->serverHandle));
			@socket_close($this->serverHandle);
			Logger::err($err);
			exit("error: {$err}.\n");
		}

		$bind = @socket_bind($this->serverHandle, $this->ip, $this->port);
		if ( $bind == false ) {
			$err = @socket_strerror(@socket_last_error($this->serverHandle));
			@socket_close($this->serverHandle);
			Logger::err($err);
			exit("error: socket bind fail.{$err}\n");
		}

		$listen = @socket_listen($this->serverHandle, $this->backlog);
		if ( $listen == false ) {
			$err = @socket_strerror(@socket_last_error($this->serverHandle));
			@socket_close($this->serverHandle);
			Logger::err($err);
			exit("error:{$err}.\n");
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
				$this->backlog    = false;
				$this->pidFile	  = false;
				$this->processNum = false;
				$this->service();
				exit(0);
			}
			$this->children[$pid] = time();
		}
	}

	/**
	 * 监控主进程需要做的事情,内部调用
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

				if ( count($this->children) > 0 ) {
					$this->ping();
				}
			} else {
				if ( $pid > 0 && array_key_exists($pid, $this->children) ) {
					unset($this->children[$pid]);
					$this->createProcess();
				} else {
					sleep(2);
					$this->monitor();
				}
			}
		}
		@socket_close($this->serverHandle);
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
			$socket = @socket_accept($this->serverHandle);
			if (!$socket) continue;
			$hasErr = false;
			$errMsg = '';

			$ret = @socket_getpeername($socket, $ip, $port);
			$this->clientIp = $ip;
			if($ret === false) {
				$hasErr = true;
				$errMsg = 'system error,can not get client ip';
			}
			unset($ret);

			// 判断白名单
			if ( $hasErr === false && !empty($this->whitelist) && !in_array($ip, $this->whitelist) ) {
				$hasErr = true;
				$errMsg = "{$ip} is not allowed";
			}

			// 判断黑名单
			if ( $hasErr === false && !empty($this->blacklist) && in_array($ip, $this->blacklist) ) {
				$hasErr = true;
				$errMsg = "{$ip} is not allowed";
			}

			// set timeout
			$rto = array('sec' => 3, 'usec' => 0);
			@socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, $rto);

			$message = '';
			if ( $hasErr === false ) {
				if ( $this->wrap ) {
					$message = NetUtil::tcpSocketRead($socket, $this->maxLength);
					if ($message === false) {
						$hasErr = true;
						$errMsg = NetUtil::$errMsg;
					}
				} else {
					$message = @socket_read($socket, $this->maxLength);
					if ( $message === false ) {
						$hasErr = true;
						$errMsg = @socket_strerror(@socket_last_error($socket));
					}
				}

			}

			if ( $hasErr === true ) {
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

			if ( $this->wrap ) {
				$ret = NetUtil::tcpSocketWrite($socket, $response);
				if ( $ret == false ) {
					Logger::err(NetUtil::$errMsg);
					$this->errResponseNum++;
				} else {
					$this->succResponseNum++;
				}
			} else {
				$ret = @socket_write($socket, $response);
				if ( $ret === false ) {
					$errMsg = @socket_strerror(@socket_last_error($socket));
					Logger::err($errMsg);
					$this->errResponseNum++;
				} else {
					$this->succResponseNum++;
				}
			}

			@socket_close($socket);
			unset($socket);
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
	 * @return string 返回处理后的结果
	 */
	abstract public function task($message, $goodBag = true, $errMsg = '');

	/**
	 * 创建一个进程
	 */
	private function createProcess()
	{
		$pid = pcntl_fork();
		if ( $pid == -1 ) {
			Logger::err("cannot create process");
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
				if ( empty($this->children) ) break;
				foreach ($this->children as $k => $v) {
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
		$tip = "usage: %server% [start | stop] -h ip -p port -n process_num [-c cfg_id] [-f]\n";

		$param['cmd'] =	isset($_SERVER['argv'][1]) ? strtolower($_SERVER['argv'][1]) : 'start';

		if ( $param['cmd'] != 'stop' && $param['cmd'] != 'start' ) {
			exit($tip);
		}

		$opts = getopt('h:p:n:c:f');

		if ( !isset($opts['h']) || !isset($opts['p']) || !isset($opts['n']) ) {
			exit($tip);
		}

		foreach ( $opts as $key => $val ) {
			$val = trim($val, '=');
			switch ( $key ) {
				case 'h' :
					if (!ToolUtil::checkIP($val)) {
						Logger::err("ip {$val} is invalid");
						exit("ip[-h] is invalid\n");
					}
					$param['h'] = $val;
					break;
				case 'p' :
					$val = intval($val);
					if ($val > 65535 || $val < 1025) {
						Logger::err("port[-p] {$val} must between 1025 and 65535");
						exit("port[-p] must be between 1025 and 65535\n");
					}
					$param['p'] = $val;
					break;
				case 'n' :
					$val = intval($val);
					if ($val > 500 || $val < 1) {
						Logger::err("process num[-n] {$val} must between 1 and 500");
						exit("process num[-n] must between 1 and 500\n");
					}
					$param['n'] = $val;
					break;
				case 'c' :
					$val = intval($val);
					if ($val < 0) {
						Logger::err("config id[-c] {$val} can not be less than 0");
						exit("config id[-c] can not be less than 0\n");
					}
					$param['c'] = $val;
					break;
				case 'f' :
					if ($val === false) {
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
		if ( file_exists($this->pidFile) ) {
			NetUtil::tcpCmd($this->ip, $this->port, '');
			usleep(100);
		}
	}
}

//End of script

