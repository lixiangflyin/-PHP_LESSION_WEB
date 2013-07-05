<?php
/**
 * Example:
 * $client = new TP_NetClient_TCP; //TP_NetClient_TCP or TP_NetClient_UDP 
 * if($client->connect('127.0.0.1', 80, 0.5)) //Host,Port,Timeout
 * {
 *     $client->send("GET / HTTP/1.1\r\n\r\n");
 *     echo $client->recv();
 * }
 * else
 * {
 *     echo $client->code;
 *     echo $client->msg;
 * }
 */

/**
 * 网络客户端封装基类
 * @author tianfenghan
 * @package TPLib.Net
 * @subpackage Client
 */
class TP_NetClient
{
	protected static $sock;
	protected static $host;     //Server Host
	protected static $port;     //Server Port
	protected static $handle;
	protected static $timeout_send;
	protected static $timeout_recv;
	protected static $l5_stime;
	protected static $l5_etime;
	protected static $myl5;
	public static $sendbuf_size = 65535;
	public static $recvbuf_size = 65535;
	
	public static $code = 0;
	public static $msg = '';
	
	const ERR_RECV_TIMEOUT = 11;  //接收数据超时，server端在规定的时间内没回包
	/**
	 * 错误信息赋值
	 */
	protected static function set_error()
	{
		self::$code = socket_last_error(self::$sock);
		self::$msg = socket_strerror(self::$code);
		socket_clear_error(self::$sock);
	}
	/**
	 * 设置超时
	 * @param float $recv_timeout 接收超时
	 * @param float $send_timeout 发送超时
	 */
	public static function set_timeout($timeout_recv,$timeout_send)
	{
		$_timeout_recv_sec = (int)$timeout_recv;
		$_timeout_send_sec = (int)$timeout_send;
		
		self::$timeout_recv = $timeout_recv;
		self::$timeout_send = $timeout_send;

		$_timeout_recv = array('sec'=>$_timeout_recv_sec,'usec'=>(int)(($timeout_recv - $_timeout_recv_sec)*1000*1000));
		$_timeout_send = array('sec'=>$_timeout_send_sec,'usec'=>(int)(($timeout_send - $_timeout_send_sec)*1000*1000));

		self::setopt(SO_RCVTIMEO, $_timeout_recv);
		self::setopt(SO_SNDTIMEO, $_timeout_send);
	}
	/**
	 * 设置socket参数
	 */
	public static function setopt($opt,$set)
	{
		socket_set_option(self::$sock, SOL_SOCKET, $opt, $set);
	}
	/**
	 * 获取socket参数
	 */
	public static function getopt($opt)
	{
		return socket_get_option(self::$sock, SOL_SOCKET, $opt);
	}
	
	public static function get_socket()
	{
		return self::$sock;
	}

	public static function set_bufsize($sendbuf_size,$recvbuf_size)
	{
		self::setopt(SO_SNDBUF, $sendbuf_size);
		self::setopt(SO_RCVBUF, $recvbuf_size);
	}
	/**
	 * 析构函数
	 */
	public function __destruct()
	{
		self::close();
	}
}

/**
 * UDP客户端
 * @author tianfenghan
 */
class TP_NetClient_UDP extends TP_NetClient
{
	public $remote_host;
	public $remote_port;

	/**
	 * 连接到服务器
	 * 接受一个浮点型数字作为超时，整数部分作为sec，小数部分*100万作为usec
	 * 
	 * @param string $host 服务器地址
	 * @param int    $port 服务器地址 
	 * @param float  $timeout 超时默认值，连接，发送，接收都使用此设置
	 * @param bool   $udp_connect 是否启用connect方式
	 */
	function connect($host,$port,$timeout = 0.1,$udp_connect = true)
	{
		//判断超时为0或负数
		if(empty($host) or empty($port) or $timeout <=0)
		{
			self::$code = -10001;
			self::$msg = "param error";
			return false;
		}
		self::$host = $host;
		self::$port = $port;
		self::$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
		self::set_timeout($timeout,$timeout);
		self::set_bufsize(self::$sendbuf_size, self::$recvbuf_size);
		
		//是否用UDP Connect
		if($udp_connect !==true)
		{
			return true;
		}
		if(socket_connect(self::$sock, $host, $port))
		{
			//清理connect前的buffer数据遗留
			while(@socket_recv(self::$sock, $buf, 65535 , MSG_DONTWAIT));
			return true;
		}
		else
		{
			self::set_error();
			return false;
		}
	}
	/**
	 * 发送数据
	 * @param string $data
	 * @return $n or false
	 */
	function send($data)
	{
		$len = strlen($data);
		$n = socket_sendto(self::$sock, $data, $len , 0, self::$host, self::$port);
		
		if($n === false or $n < $len)
		{
			self::set_error();
			return false;
		}
		else
		{
			return $n;
		}
	}
	/**
	 * 接收数据，UD包不能分2次读，recv后会清除数据包，所以必须要一次性读完
	 * 
	 * @param int $length 接收数据的长度
	 * @param bool $waitall 等待接收到全部数据后再返回，注意waitall=true,超过包长度会阻塞住
	 */
	function recv($length = 65535,$waitall = 0)
	{
		if($waitall) $waitall = MSG_WAITALL;
		$ret = socket_recvfrom(self::$sock, $data, $length, $waitall, self::$remote_host, self::$remote_port);
		if($ret === false)
		{
			self::set_error();
			//重试一次，这里为防止意外，不使用递归循环
			if(self::$code==4)
			{
				socket_recvfrom(self::$sock, $data, $length, $waitall, self::$remote_host, self::$remote_port);
			}
			else
			{
				return false;
			}
		}
		return $data;
	}
	/**
	 * 关闭socket连接
	 */
	function close()
	{
		if(self::$sock) socket_close(self::$sock);
		self::$sock = null;
	}
}

/**
 * TCP客户端
 * @author tianfenghan
 */
class ISocketClient extends TP_NetClient
{
	public static $errCode = 0;
	public static $errMsg = '';
	public static $maxPackLen = 1048576;//1024*1024
	/**
	 * 是否重新连接
	 */
	public static $try_reconnect = true;
	/**
	 * 发送数据
	 * @param string $data
	 */
	public static function send($data)
	{
		$length = strlen($data);
		$written = 0;
		$t1 = microtime(true);
		//总超时，for循环中计时
		while($written < $length)
		{
			$n = socket_write(self::$sock, substr($data, $written));
			//超过总时间
			if(microtime(true) > self::$timeout_send + $t1)
			{
				return false;
			}
			if($n===false) //反过来
			{
				$errno = socket_last_error(self::$sock);
				//判断错误信息，EAGAIN EINTR，重写一次
				if($errno == 11 or $errno==4)
				{
					continue;
				}
				else
				{
					return false;
				}
			}
			$written += $n;
		}
		return $written;
	}
	/**
	 * 接收数据
	 * @param int $length 接收数据的长度
	 * @param bool $waitall 等待接收到全部数据后再返回，注意这里超过包长度会阻塞住
	 */
	public static function recv($length = 65535 ,$waitall = 0)
	{
		if($waitall) $waitall = MSG_WAITALL;
		$ret = socket_recv(self::$sock, $data, $length, $waitall);

		if($ret === false)
		{
			self::set_error();
			//重试一次，这里为防止意外，不使用递归循环
			if(self::$code==4)
			{
				socket_recv(self::$sock, $data, $length, $waitall);
			}
			else 
			{
				return false;
			}
		}
		return $data;
	}
	/**
	 * 连接到服务器
	 * 接受一个浮点型数字作为超时，整数部分作为sec，小数部分*100万作为usec
	 *
	 * @param string $host 服务器地址
	 * @param int    $port 服务器地址
	 * @param float  $timeout 超时默认值，连接，发送，接收都使用此设置
	 */
	public static function connect($host,$port,$timeout = 0.1)
	{
		//判断超时为0或负数
		if(empty($host) or empty($port) or $timeout <=0)
		{
			self::$code = -10001;
			self::$msg = "param error";
			return false;
		}
		self::$host = $host;
		self::$port = $port;
		//创建socket
		self::$sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
		if(self::$sock === false)
		{
			self::$set_error();
			return false;
		}
		//设置connect超时
		self::set_timeout($timeout,$timeout);

		//连接服务器
		if(socket_connect(self::$sock, self::$host, self::$port))
		{
			return true;
		}
		elseif(self::$try_reconnect)
		{
			if(socket_connect(self::$sock, self::$host, self::$port))
			{
				return true;
			}
		}
		self::set_error();
		return false;
	}
	public static function recvForPSF() {
		$ret = socket_recv(self::$sock, $t_data, 4, MSG_WAITALL);
		if($ret != 4) {
			self::$errCode = 1201;
			self::$errMsg = "recv head error";
			return false;
		}
		$recv_data = "";
		$arr = unpack('Ilength',$t_data);
		$all_len = $arr['length'];
		if($all_len > self::$maxPackLen) {
			self::$errCode = 1203;
			self::$errMsg = "package len $all_len over " . $maxPackLen;
			return false;
		}
		$read_len = 4;
		while($all_len - $read_len > 0) {
			$ret = socket_recv(self::$sock, $data, $all_len - $read_len, MSG_WAITALL);
			if($ret === false)
			{
				self::set_error();
				if(self::$code==4)
				{
					$ret = socket_recv(self::$sock, $data, $all_len - $read_len, MSG_WAITALL);
				}
				else 
				{
					self::$errCode = 1202;
					self::$errMsg = "recv data error";
					return false;
				}
			}
			$recv_data .= $data;
			$read_len += $ret;
		}
		return $t_data.$recv_data;
	}
	/*
	 * 发送数据到PSF模块
	 */
	public static function sendData($module, $data,$timeout = 0.5, $if_recv = false, $repeat = 1) {
		global $_CPS_L5_MOD_CONFIG;
		if(!class_exists('L5')) {
			self::$errCode = 1001;
			self::$errMsg = "miss l5 class";
			return false;
		}
		self::$myl5 = new L5;
		$l5_config = $_CPS_L5_MOD_CONFIG;
		if(!isset($l5_config[$module])) {
			self::$errCode = 1002;
			self::$errMsg = "module($module) miss l5 config";
			return false;
		}
		$l5_ret = self::$myl5->getRoute($l5_config[$module]['modid'], $l5_config[$module]['cmdid']);
		if(!isset($l5_ret['host_ip']) || !isset($l5_ret['host_port']) || !$l5_ret['host_ip'] || !$l5_ret['host_port']) {
			//get error
			Logger::err('get l5 error,return:'.var_export($l5_ret, true));
			//get default config
			global $_CPS_SERVER_CONFIG;
			$default_servers = $_CPS_SERVER_CONFIG;
			$l5_ret['host_ip'] = $default_servers[$module]['IP'];
			$l5_ret['host_port'] = $default_servers[$module]['PORT'];
		}
		$cf = array('IP' => $l5_ret['host_ip'], 'PORT' => $l5_ret['host_port']);
		self::$l5_stime = self::getMicrotime();
		if(!self::connect($cf['IP'], $cf['PORT'], $timeout)) {
			//file_put_contents('/tmp/testSockSendData001.txt', $module."\n".print_r($psf_config, true)."\n".print_r($cf, true)."\n".$timeout."\n", FILE_APPEND);
			self::$myl5->updateRouteStatus(-1, -1);
			self::close();
			if($repeat > 0) {
				return self::sendData($module, $data,$timeout = 0.5, $if_recv, --$repeat);
			}
			self::$errCode = 1004;
			self::$errMsg = "connect error ip:{$cf['IP']} port:{$cf['PORT']}";
			return false;
		}
		//file_put_contents('/tmp/testSockSendData002.txt', print_r($cf, true)."\n", FILE_APPEND);
		$data = IPSFPackageUtils::packData($data);
		//file_put_contents('/tmp/testSockSendData003.txt', print_r($data, true)."\n", FILE_APPEND);
		if($data === false) {
			self::$errCode = 1005;
			self::$errMsg = "packData error";
			self::close();
			return false;
		}
		$sendLen = self::send($data);
		//file_put_contents('/tmp/testSockSendData004.txt', $sendLen."\n", FILE_APPEND);
		if($sendLen === false) {
			self::$myl5->updateRouteStatus(-1, -1);
			self::close();
			if($repeat > 0) {
				return self::sendData($module, $data,$timeout = 0.5, $if_recv, --$repeat);
			}
			self::$errCode = 1006;
			self::$errMsg = "send data error";
			return false;
		}
		//just send data
		if(!$if_recv) {
			//l5 report
			self::$l5_etime = self::getMicrotime();
			self::$myl5->updateRouteStatus(0, self::$l5_etime - self::$l5_stime);
			self::close();
		}
		return $sendLen;
	}
	/*
	 * 解包PSF模块数据
	 */
	public static function recvData() {
		$data = self::recvForPSF();
		self::$l5_etime = self::getMicrotime();
		//file_put_contents('/tmp/testSockRecvData001.txt', print_r($data, true)."\n", FILE_APPEND);
		self::close();
		if($data === false) {
			self::$myl5->updateRouteStatus(-1, -1);
			return false;
		}
		self::$myl5->updateRouteStatus(0, self::$l5_etime - self::$l5_stime);
		$recvData = IPSFPackageUtils::unPackData($data);
		//file_put_contents('/tmp/testSockRecvData002.txt', print_r($recvData, true)."\n", FILE_APPEND);
		if($recvData === false) {
			self::$errCode = 1102;
			self::$errMsg = IPSFPackageUtils::$errMsg;
			return false;
		}
		return $recvData;
	}
	/*
	 * 发包并且收包
	 */
	public static function sendAndRecvData($module, $data,$timeout = 0.5) {
		$sendLen = self::sendData($module, $data, $timeout, true);
		if($sendLen === false) {
			return false;
		}
		$recvData = self::recvData();
		if($recvData === false) {
			return false;
		}
		return $recvData;
	}
	/**
	 * 关闭socket连接
	 */
	public static function close()
	{
		if(self::$sock) socket_close(self::$sock);
		self::$sock = null;
	}

	public static function getMicrotime(){
		list($usec, $sec) = explode(' ', microtime());
		return ((float)($usec*1000000) + (float)($sec*1000000));
	}
}
/**
 * 发送UDP包
 * @param $host
 * @param $port
 * @param $pkg
 */
/*
function tp_sendto($host, $port, $pkg)
{
	static $netclients;
	$key = $host.':'.$port;
	if(isset($netclients[$key]))
	{
		$cli = $netclients[$key];
	}
	else 
	{
		$cli = new TP_NetClient_UDP;
		$cli->connect($host, $port, 1, false);
		$netclients[$key] = $cli;
	}
	$cli->send($pkg);
}

unset($client);

$client = new TP_NetClient_TCP; //TP_NetClient_TCP or TP_NetClient_UDP 
if($client->connect('10.96.78.106', 19001, 1)) //Host,Port,Timeout
{
    $client->send("test".time());
     echo $client->recv();
}
else
{
     echo $client->code;
     echo $client->msg;
}

unset($client);

echo "Done.\n";
*/
