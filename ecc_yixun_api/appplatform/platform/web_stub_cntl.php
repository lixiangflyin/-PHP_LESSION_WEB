<?php

include "byte_stream.php";
include "c2c_pkg_head.php";

define('MODULE_INVOKE_FOR_C2C', 2141000002);

// enum ResultType
define('MODULE_INVOKE_SUCCESS', 0);
define('MODULE_INVOKE_FAIL', 1);
define('MODULE_INVOKE_LOGIC_FAIL', 2);
define('MODULE_INVOKE_DB_EXCEPTION', 3);
define('MODULE_INVOKE_NET_EXCEPTION', 4);
define('MODULE_INVOKE_IO_EXCEPTION', 5);
define('MODULE_INVOKE_OTHER_EXCPTION', 6);

if (!function_exists('exd_Attr_API2')) {

    function exd_Attr_API2() {

    }

}
if (!function_exists('configcenter4_reportInfo'))
{
	function configcenter4_reportInfo()
	{
	
	}
}
if (!function_exists('configcenter4_get_cmd_l5'))
{
	function configcenter4_get_cmd_l5()
	{
	
	}
}

if (!function_exists('report_module_invokeInfos'))
{
	function report_module_invokeInfos()
	{
	
	}
}
class WebStubCntl {

    var $ph = null;
    var $peer_ip = "10.6.223.128";
    var $peer_port = 53101;
    var $peer_ip_port_set = false;
    var $__STX__ = 0x55AA;
    var $STX = 0x02;
    var $ETX = 0x03;
    var $last_err_msg;
    var $itil = array(0, 0, 0); // 成功、失败、超时
    var $callerName = false; // 调用者标识

    function WebStubCntl() {
        $this->ph = new BSPkgHead;
    }

    function setPeerIPPort($sIP, $iPort) {
        $this->peer_ip = $sIP;
        $this->peer_port = $iPort;
        $this->peer_ip_port_set = true;
    }

    function getDwOperatorId() {
        return $this->ph->getDwOperatorId();
    }

    function setDwOperatorId($dwOperatorId) {
        $this->ph->setDwOperatorId($dwOperatorId);
    }

    function getDwSerialNo() {
        return $this->ph->getDwSerialNo();
    }

    function setDwSerialNo($dwSerialNo) {
        $this->ph->setDwSerialNo($dwSerialNo);
    }

    function getDwUin() {
        return $this->ph->getDwUin();
    }

    function setDwUin($dwUin) {
        $this->ph->setDwUin($dwUin);
    }

    function getSPassport() {
        return $this->ph->getSPassport();
    }

    function setSPassport($passport) {
        $this->ph->setSPassport($passport);
    }

    function getDwCommand() {
        return $this->ph->getDwCommand();
    }

    function setDwCommand($command) {
        $this->ph->setDwCommand($command);
    }

    function getWVersion() {
        return $this->ph->getWVersion();
    }

    function setWVersion($version) {
        $this->ph->setWVersion($version);
    }

    function getCallerName() {
        return $this->callerName;
    }

    function setCallerName($name) {
        $this->callerName = $name;
    }

    function getItilId() {
        return $this->itil;
    }

    function setItilId($itil_success = 0, $itil_fail = 0, $itil_timeout = 0) {
        $this->itil = array($itil_success, $itil_fail, $itil_timeout);
    }

    function getLastErrMsg() {
        return $this->last_err_msg;
    }

    function invoke(&$req, &$resp, $timeout = 1) {
        if (!$this->callerName) {
            trigger_error('callerName must be set! Use $cntl->setCallerName("YOUR_APP_NAME").');
            exit;
        }
        $key = $req->getCmdId();
        $begin = microtime();
        // 计算Request包长度
        $bsdummy = new ByteStream;
        $bsdummy->setRealWrite(false);
        $req->Serialize($bsdummy);
        $dwBodyLen = $bsdummy->getWrittenLength();

        // 计算整个包长度
        $dwPkgLength = 1 + $this->ph->iPkgHeadLength + $dwBodyLen + 1;
        // 构建包头
        $this->ph->setDwCommand($req->getCmdId());
        $this->ph->setDwLength($dwPkgLength);
        // 构建序列化buffer
        $bs = new ByteStream;

        // 序列化
        $bs->pushUint16_t($this->__STX__);
        $bs->pushUint32_t($dwPkgLength);
        $bs->pushByte($this->STX);
        $this->ph->Serialize($bs);
        $req->Serialize($bs);
        $bs->pushByte($this->ETX);

        $bs2 = new ByteStream;
        $ip = "";
        $port = 0;

        if (!$this->peer_ip_port_set) {
            $retCode = $this->get_inet_addr($key, $this->getDwUin(), $ip, $port);
            if ($retCode != 0) {
                $this->last_err_msg = "get_inet_addr($key, ".$this->getDwUin().") failed";
                return -1;
            }
            $this->setPeerIPPort($ip, $port);
        }

        $time_start = microtime(true);
        $ret = $this->sendAndRecv($bs, $bs2, $timeout);
        $time_end = microtime(true);
        $time_used = ($time_end - $time_start) * 1000;

        $cmdid = $req->getCmdId(); // Cmd which is timeout
        $str_cmdid = sprintf("0x%x", $cmdid);
        $len = strlen($str_cmdid);
        $calleeId = substr($str_cmdid, 2, $len - 6); // 9001 of 0x90011801, 10 of 0x101801
        $calleeInfId = substr($str_cmdid, 2); // 90011801 of 0x90011801, 101801 of 0x101801
        //var_dump("time_used = $time_used, calleeId=$calleeId, calleeInfId=$calleeInfId");

        if ($ret != 0) {
            // 上报L5调用结果
            configcenter4_reportInfo($str_cmdid, 0, "$ip:$port", $ret, $time_used);

            // 上报模调
            $bizRet = MODULE_INVOKE_NET_EXCEPTION;
            report_module_invokeInfos(
                    MODULE_INVOKE_FOR_C2C, // 业务所属平台(基础组,boss,sns...)，见上面的MicInfoType定义
                    $this->callerName, // 调用者标识
                    $calleeId, // 被调者的模块ID
                    $calleeInfId, // 被调者的接口ID
                    ip2long_uint32(isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : '127.0.0.1'), // 调用者的IP
                    ip2long_uint32($ip), // 被调者的IP
                    $cmdid, // 调用返回码
                    $time_used, // 调用耗时(ms)
                    $bizRet // 调用结果，见上面ResultType定义
            );

            // 上报itil
            list($itil_success, $itil_fail, $itil_timeout) = $this->getItilId();
            if ($itil_fail)
                exd_Attr_API2($itil_fail, 1);
            return $cmdid;
        }

        $bSTX = $bs2->popByte();
        if ($bSTX != $this->STX) {
            $this->last_err_msg = ("STX not match:" . $bSTX . " vs " . $this->STX);
            return -1;
        }

        $this->ph->UnSerialize($bs2);
        $resp->UnSerialize($bs2);

        if (!$bs2->isGood()) {
            $this->last_err_msg = ("resp.UnSerialize is not good.");
            return -2;
        }
        $bETX = $bs2->popByte();
        if ($bETX != $this->ETX) {
            $this->last_err_msg = ("ETX not match:" . $bETX . " vs " . $this->ETX);
            return -3;
        }

        // 上报L5调用结果
        configcenter4_reportInfo($str_cmdid, 0, "$ip:$port", $ret, $time_used);

        // 上报模调
        $bizRet = $resp->result == 0 ? MODULE_INVOKE_SUCCESS : MODULE_INVOKE_LOGIC_FAIL;
        //var_dump("normal: result = {$resp->result}, time=$time_used, bizRet=$bizRet");

        report_module_invokeInfos(
                MODULE_INVOKE_FOR_C2C, // 业务所属平台(基础组,boss,sns...)，见上面的MicInfoType定义
                $this->callerName, // 调用者标识
                $calleeId, // 被调者的模块ID
                $calleeInfId, // 被调者的接口ID
                ip2long_uint32(isset($_SERVER['SERVER_ADDR']) ? $_SERVER['SERVER_ADDR'] : '127.0.0.1'), // 调用者的IP
                ip2long_uint32($ip), // 被调者的IP
                $resp->result, // 调用返回码
                $time_used, // 调用耗时(ms)
                $bizRet // 调用结果，见上面ResultType定义
        );
        //echo "All done, cost ".((microtime() - $begin) * 1000)."ms\n";
        // 上报itil
        list($itil_success, $itil_fail, $itil_timeout) = $this->getItilId();
        if ($itil_success)
            exd_Attr_API2($itil_success, 1);
        return 0;
    }

    function sendAndRecv(&$bs, &$bs2, $timeout) {
        //echo "sendAndRecv\n";
        // 连接到服务器
        $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
        $timeout_ms = defined('TIMEOUT_MS') ? TIMEOUT_MS : 200;
        @socket_set_option($socket, SOL_SOCKET, SO_SNDTIMEO, array("sec" => $timeout, "usec" => $timeout_ms));
        @socket_set_option($socket, SOL_SOCKET, SO_RCVTIMEO, array("sec" => $timeout, "usec" => $timeout_ms));
        if (!$socket) {
            $this->last_err_msg = ("Unable to create socket");
            return -1;
        }
        //socket_set_nonblock($socket);

        $time = time();

        //echo "Connecting to $this->peer_ip:$this->peer_port with timeout=$timeout...";
        $ret = $this->connect_with_timeout($socket, $this->peer_ip, $this->peer_port, $timeout);
        if ($ret != 0) {
            // 上报itil
            list($itil_success, $itil_fail, $itil_timeout) = $this->getItilId();
            if ($itil_timeout)
                exd_Attr_API2($itil_timeout, 1);

            $err_msg_tmp = $this->last_err_msg;
            $this->last_err_msg = ("Connecting to $this->peer_ip:$this->peer_port with timeout=$timeout...failed ") . $err_msg_tmp;
            return -2;
        }
        //echo "\nOK!"."";
        // 发送数据
        $timeleft = $timeout - (time() - $time);
        //echo "Sending to $this->peer_ip:$this->peer_port with timeout=$timeout...";
        $ret = $this->send_with_timeout($socket, $bs->getWrittenBuffer(), $bs->getWrittenLength(), $timeleft);
        if ($ret != 0) {
            $this->last_err_msg = ("Sending to $this->peer_ip:$this->peer_port with timeout=$timeout...failed");
            return -3;
        }
        //echo $bs->getWrittenLength()." bytes OK!"."\n";
        // 接收数据
        $timeleft = $timeout - (time() - $time);
        //echo "Recving data from $this->peer_ip:$this->peer_port with timeout=$timeout...";
        $recv_buffer = $this->recv_with_timeout($socket, 2, $timeout);
        if ($recv_buffer == "") {
            $this->last_err_msg = ("recv with_timeout " . $this->peer_ip . ":" . $this->peer_port . " timeout:" . $timeleft);
            return -4;
        }
        //echo "\nrecv_buffer:".$recv_buffer;
        $bs2->setBuffer4Unserialze($recv_buffer);
        $__STX__2 = $bs2->popUint16_t();
        if ($__STX__2 != $this->__STX__) {
            $this->last_err_msg = ("__STX__ not match:" . $__STX__2 . " vs " . $this->__STX__);
            return -5;
        }

        $timeleft = $timeout - (time() - $time);
        $recv_buffer = $this->recv_with_timeout($socket, 4, $timeout);
        $bs2->setBuffer4Unserialze($recv_buffer);
        $dwRecvPkgLen = $bs2->popUint32_t();
        if ($dwRecvPkgLen < 0) {
            $this->last_err_msg = ("dwRecvPkgLen < 0");
            return -6;
        }
        //echo "\ndwRecvPkgLen:".$dwRecvPkgLen;
        // 获取通信数据
        $timeleft = $timeout - (time() - $time);
        //echo "\ndwRecvPkgLen:".$dwRecvPkgLen.", timeout:$timeout";
        $recv_buffer = $this->recv_with_timeout($socket, $dwRecvPkgLen, $timeleft);
        //echo "\nrecv_buffer:[".$recv_buffer."]";
        if ($recv_buffer == "") {
            $this->last_err_msg = ("Recv from $this->peer_ip:$this->peer_port failed, timeout:" . $timeout);
            return -3;
        }

        //echo "$dwRecvPkgLen bytes OK!"."\n";
        $bs2->setBuffer4Unserialze($recv_buffer);

        socket_close($socket);
        return 0;
    }

    function get_inet_addr($key, $dwUin, &$peer_ip, &$peer_port) {
        //从配置中心api取ip:port
        //echo "mid get_inet_addr:".$key.", peer_ip:".$peer_ip.", peer_port:".$peer_port."\n";
        global $aoip, $aoport;
        if ($aoip && $aoport) {
            $net = "$aoip:$aoport";
        } else {
            $net = configcenter4_get_cmd_l5($key, 0, $dwUin);
        }
        //$net = "172.25.34.101:12001";
        //var_dump($net, $key, $dwUin);
        $pos = strpos($net, ":");
        if ($pos === false) {
            $this->last_err_msg = "configcenter4_get_cmd failed, inet_addr:" . $net . "";
            return -1;
        } else {
            $peer_ip = substr($net, 0, $pos);
            $peer_port = substr($net, $pos + 1);
        }
        return 0;
    }

    function connect_with_timeout($socket, $host, $port, $timeout) {

        $time = time();
        while (!@socket_connect($socket, $host, $port)) {

            if ((time() - $time) >= $timeout) {
                socket_close($socket);
                $this->last_err_msg = "connect to " . $host . ":" . $port . " timout:" . $timeout . "\n";
                return -1;
            }
            $err = socket_last_error($socket);
            if ($err == 115 || $err == 114) {
                //sleep(1);
                continue;
            }
            $this->last_err_msg = "strerror[" . socket_strerror($err) . "] ";
            return -2;
        }

        return 0;
    }

    function send_with_timeout($socket, &$send_buffer, $byte2send, $timeout) {
        socket_set_nonblock($socket);
        $time = time();
        $send_offset = 0;
        while ($byte2send > 0) {
            if ((time() - $time) >= $timeout) {
                socket_close($socket);
                $this->last_err_msg = "send_with_timeout:$timeout\n";
                return -1;
            }
            $bytes_sent = socket_write($socket, substr($send_buffer, $send_offset, $byte2send), $byte2send);
            //var_dump('bytes_sent: '.$bytes_sent.', byte2send: '.$byte2send);
            if ($bytes_sent) {
                $send_offset += $bytes_sent;
                $byte2send -= $bytes_sent;
            }
        }
        socket_set_block($socket);
        return 0;
    }

    function recv_with_timeout($socket, $byte2recv, $timeout) {
        //socket_set_nonblock($socket);
        $time = time();
        $recv_buffer = "";
        while ($byte2recv > 0) {
            if ((time() - $time) >= $timeout) {
                socket_close($socket);
                return "";
            }
            $recv = socket_read($socket, $byte2recv, PHP_BINARY_READ);
            if ($recv) {
                $recv_buffer .= $recv;
                $byte2recv -= strlen($recv);
            }
        }
        //socket_set_block($socket);
        //echo "\nrecv_buffer:".$recv_buffer;
        return $recv_buffer;
    }

    function getTimeout_ms() {
        return $this->timeout_ms;
    }

    function setTimeout_ms($timeout_ms) {
        $this->timeout_ms = $timeout_ms;
    }

}

function ip2long_uint32($ip) {
    $arr = explode('.', $ip);
    if (sizeof($arr) != 4) {
        return -1;
    }
    $ipLong = $arr[3] * 16777216 + $arr[2] * 65536 + $arr[1] * 256 + $arr[0];
    return $ipLong;
}

